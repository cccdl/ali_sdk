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
        return $this->postBody('error_response');
    }


}