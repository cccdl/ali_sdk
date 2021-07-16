<?php

namespace cccdl\ali_sdk\Alipay\Util;

use cccdl\ali_sdk\Alipay\BasicAliPay;
use cccdl\ali_sdk\Exceptions\cccdlException;
use cccdl\ali_sdk\Exceptions\InvalidResponseException;
use GuzzleHttp\Exception\GuzzleException;

/**
 * 换取授权访问令牌
 * Class App
 * @package AliPay
 */
class SystemOauthToken extends BasicAliPay
{
    /**
     * App constructor.
     * @param array $options
     */
    public function __construct(array $options)
    {
        parent::__construct($options);
        $this->options->set('method', 'alipay.system.oauth.token');
        $this->method = str_replace('.', '_', $this->options['method']) . '_response';
    }


    /**
     * @param array $options
     * @return mixed
     * @throws GuzzleException
     * @throws InvalidResponseException
     * @throws cccdlException
     */
    public function apply(array $options)
    {
        $this->options->set('grant_type', $options['grant_type']);
        $this->options->set('code', $options['code']);
        $this->options->set('sign', $this->getSign());
        return $this->postBody();
    }


    /**
     * @return mixed|void
     * @throws InvalidResponseException
     * @throws GuzzleException
     * @throws cccdlException
     */
    protected function postBody()
    {
        $data = $this->post();
        if (isset($data['error_response']['code']) && $data['error_response']['code'] !== '10000') {
            throw new InvalidResponseException(
                "Error: " .
                (empty($data['error_response']['code']) ? '' : "{$data['error_response']['msg']} [{$data['error_response']['code']}]\r\n") .
                (empty($data['error_response']['sub_code']) ? '' : "{$data['error_response']['sub_msg']} [{$data['error_response']['sub_code']}]\r\n"),
                $data['error_response']['code'], $data
            );
        }

        return $data[$this->method];
    }
}