<?php

namespace cccdl\ali_sdk\Alipay\Member;

use cccdl\ali_sdk\Alipay\BasicAliPay;
use cccdl\ali_sdk\Exceptions\cccdlException;
use cccdl\ali_sdk\Exceptions\InvalidResponseException;

/**
 * 实名证件信息比对验证预咨询
 * Class App
 * @package AliPay
 */
class CertdocCertverifyPreconsult extends BasicAliPay
{
    private string $method;

    /**
     * App constructor.
     * @param array $options
     */
    public function __construct(array $options)
    {
        parent::__construct($options);
        $this->options->set('method', 'alipay.user.certdoc.certverify.preconsult');
        $this->method = str_replace('.', '_', $this->options['method']) . '_response';
    }


    /**
     * @param array $options
     * @return mixed
     * @throws InvalidResponseException
     * @throws cccdlException
     */
    public function apply(array $options)
    {
        $this->options->set('biz_content', json_encode($this->params->merge($options), 256));
        $this->options->set('sign', $this->getSign());
        $data = $this->post();

        if (!isset($data[$this->method]['code']) || $data[$this->method]['code'] !== '10000') {
            throw new InvalidResponseException(
                "Error: " .
                (empty($data[$this->method]['code']) ? '' : "{$data[$this->method]['msg']} [{$data[$this->method]['code']}]\r\n") .
                (empty($data[$this->method]['sub_code']) ? '' : "{$data[$this->method]['sub_msg']} [{$data[$this->method]['sub_code']}]\r\n"),
                $data[$this->method]['code'], $data
            );
        }
        return $data[$this->method];
    }
}