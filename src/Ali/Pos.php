<?php


namespace cccdl\ali_sdk\Ali;

use cccdl\ali_sdk\Exceptions\InvalidResponseException;
use cccdl\ali_sdk\Exceptions\LocalCacheException;
/**
 * 支付宝刷卡支付
 * Class Pos
 * @package AliPay
 */
class Pos extends BasicAliPay
{
    /**
     * Pos constructor.
     * @param array $options
     */
    public function __construct(array $options)
    {
        parent::__construct($options);
        $this->options->set('method', 'alipay.trade.pay');
        $this->params->set('product_code', 'FACE_TO_FACE_PAYMENT');
    }

    /**
     * 创建数据操作
     * @param array $options
     * @return array|bool
     * @throws InvalidResponseException
     * @throws LocalCacheException
     */
    public function apply(array $options)
    {
        return $this->getResult($options);
    }
}