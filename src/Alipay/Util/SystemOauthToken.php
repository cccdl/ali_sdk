<?php
namespace cccdl\ali_sdk\Alipay\Util;

use cccdl\ali_sdk\Alipay\BasicAliPay;
use cccdl\ali_sdk\Exceptions\InvalidResponseException;
use cccdl\ali_sdk\Exceptions\LocalCacheException;

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
    }


    /**
     * @throws LocalCacheException
     * @throws InvalidResponseException
     */
    public function apply(array $options)
    {
        return $this->getResult($options);
    }
}