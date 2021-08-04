<?php


namespace cccdl\ali_sdk\Alipay;

use cccdl\ali_sdk\Exceptions\cccdlException;
use cccdl\ali_sdk\Exceptions\InvalidArgumentException;
use cccdl\ali_sdk\Exceptions\InvalidResponseException;
use cccdl\ali_sdk\Util\Request;
use cccdl\ali_sdk\Util\Tools;
use GuzzleHttp\Exception\GuzzleException;

/**
 * 支付宝支付基类
 * Class AliPay
 * @package AliPay\Contracts
 */
abstract class BasicAliPay
{

    use Tools, Request;

    /**
     * 支持配置
     * @var DataArray
     */
    protected $config;

    /**
     * 当前请求数据
     * @var DataArray
     */
    protected $options;

    /**
     * DzContent数据
     * @var DataArray
     */
    protected $params;

    /**
     * 静态缓存
     * @var static
     */
    protected static $cache;

    /**
     * 正常请求网关
     * @var string
     */
    protected $gateway = 'https://openapi.alipay.com/gateway.do?charset=utf-8';

    /**
     * 操作api
     * @var string
     */
    protected $method;

    /**
     * AliPay constructor.
     * @param array $options
     */
    public function __construct(array $options)
    {
        $this->params = new DataArray([]);
        $this->config = new DataArray($options);
        if (empty($options['appid'])) {
            throw new InvalidArgumentException("Missing Config -- [appid]");
        }
        if (empty($options['public_key'])) {
            throw new InvalidArgumentException("Missing Config -- [public_key]");
        }
        if (empty($options['private_key'])) {
            throw new InvalidArgumentException("Missing Config -- [private_key]");
        }
        if (!empty($options['debug'])) {
            $this->gateway = 'https://openapi.alipaydev.com/gateway.do?charset=utf-8';
        }
        $this->options = new DataArray([
            'app_id' => $this->config->get('appid'),
            'charset' => empty($options['charset']) ? 'utf-8' : $options['charset'],
            'format' => 'JSON',
            'version' => '1.0',
            'sign_type' => empty($options['sign_type']) ? 'RSA2' : $options['sign_type'],
            'timestamp' => date('Y-m-d H:i:s'),
        ]);
        if (isset($options['notify_url']) && $options['notify_url'] !== '') {
            $this->options->set('notify_url', $options['notify_url']);
        }
        if (isset($options['return_url']) && $options['return_url'] !== '') {
            $this->options->set('return_url', $options['return_url']);
        }
        if (isset($options['app_auth_token']) && $options['app_auth_token'] !== '') {
            $this->options->set('app_auth_token', $options['app_auth_token']);
        }
    }

    /**
     * 获取通知数据
     * @param boolean $needSignType 是否需要sign_type字段
     * @throws InvalidResponseException
     */
    public function notify(bool $needSignType = false): array
    {
        $data = $_POST;
        if (empty($data) || empty($data['sign'])) {
            throw new InvalidResponseException('Illegal push request.', 0, $data);
        }
        $string = $this->getSignContent($data, $needSignType);
        $content = wordwrap($this->config->get('public_key'), 64, "\n", true);
        $res = "-----BEGIN PUBLIC KEY-----\n{$content}\n-----END PUBLIC KEY-----";
        if (openssl_verify($string, base64_decode($data['sign']), $res, OPENSSL_ALGO_SHA256) !== 1) {
            throw new InvalidResponseException('Data signature verification failed.', 0, $data);
        }
        return $data;
    }

    /**
     * 获取数据签名
     * 默认签名请求参数，传入str则签名str
     * @param string $str
     * @return string
     */
    protected function getSign(string $str = ''): string
    {
        if (empty($str)) {
            $str = $this->getSignContent($this->options->get(), true);
        }

        $content = wordwrap($this->trimCert($this->config->get('private_key')), 64, "\n", true);
        $string = "-----BEGIN RSA PRIVATE KEY-----\n$content\n-----END RSA PRIVATE KEY-----";
        if ($this->options->get('sign_type') === 'RSA2') {
            openssl_sign($str, $sign, $string, OPENSSL_ALGO_SHA256);
        } else {
            openssl_sign($str, $sign, $string, OPENSSL_ALGO_SHA1);
        }
        return base64_encode($sign);
    }

    /**
     * 数据签名处理
     * @param array $data 需要进行签名数据
     * @param boolean $needSignType 是否需要sign_type字段
     * @return string
     */
    protected function getSignContent(array $data, bool $needSignType = false): string
    {
        [$attrs,] = [[], ksort($data)];

        if (isset($data['sign'])) {
            unset($data['sign']);
        }
        if (empty($needSignType)) {
            unset($data['sign_type']);
        }
        foreach ($data as $key => $value) {
            if ($value === '' || is_null($value)) {
                continue;
            }
            array_push($attrs, "$key=$value");
        }
        return join('&', $attrs);
    }

    /**
     *  post请求并获取結果
     * @return mixed
     * @throws InvalidResponseException
     * @throws GuzzleException
     * @throws cccdlException
     */
    protected function postBody($key = '')
    {
        $data = $this->post();

        if (empty($key)) {
            $key = $this->method;
        }

        var_dump($data);
        if (!isset($data[$key]['code']) || $data[$key]['code'] !== '10000') {
            throw new InvalidResponseException(
                "Error: " .
                (empty($data[$key]['code']) ? '' : "{$data[$key]['msg']} [{$data[$key]['code']}]\r\n") .
                (empty($data[$key]['sub_code']) ? '' : "{$data[$key]['sub_msg']} [{$data[$key]['sub_code']}]\r\n"),
                $data[$key]['code'], $data
            );
        }
        return $data[$key];
    }


    /**
     * 应用数据操作
     * @param array $options
     * @return mixed
     */
    abstract public function apply(array $options);

}