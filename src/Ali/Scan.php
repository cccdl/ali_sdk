<?php

namespace cccdl\ali_sdk\Ali;


use cccdl\ali_sdk\Exceptions\InvalidResponseException;
use cccdl\ali_sdk\Exceptions\LocalCacheException;

/**
 * 支付宝扫码支付
 * Class Scan
 * @package AliPay
 */
class Scan extends BasicAliPay
{
    /**
     * Scan constructor.
     * @param array $options
     */
    public function __construct(array $options)
    {
        parent::__construct($options);
        $this->options->set('method', 'alipay.trade.precreate');
    }

    /**
     * 创建数据操作
     * @param array $options
     * @return array|bool
     * @throws InvalidResponseException
     * @throws LocalCacheException
     */
    public function apply($options)
    {
        return $this->getResult($options);
    }
}