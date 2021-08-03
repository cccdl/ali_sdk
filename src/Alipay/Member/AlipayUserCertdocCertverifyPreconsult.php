<?php

namespace cccdl\ali_sdk\Alipay\Member;

use cccdl\ali_sdk\Alipay\BasicAliPay;
use cccdl\ali_sdk\Exceptions\cccdlException;
use cccdl\ali_sdk\Exceptions\InvalidResponseException;
use GuzzleHttp\Exception\GuzzleException;

/**
 * 实名证件信息比对验证预咨询
 * Class App
 * @package AliPay
 */
class AlipayUserCertdocCertverifyPreconsult extends BasicAliPay
{

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
     * @throws GuzzleException
     */
    public function apply(array $options)
    {
        $this->options->set('biz_content', json_encode($this->params->merge($options), 256));
        $this->options->set('sign', $this->getSign());
        return $this->postBody();
    }
}