<?php


namespace cccdl\ali_sdk\Ali;

use cccdl\ali_sdk\Exceptions\InvalidResponseException;
use cccdl\ali_sdk\Exceptions\LocalCacheException;

/**
 * 支付宝电子面单下载
 * Class Bill
 * @package AliPay
 */
class Bill extends BasicAliPay
{
    /**
     * Bill constructor.
     * @param array $options
     */
    public function __construct(array $options)
    {
        parent::__construct($options);
        $this->options->set('method', 'alipay.data.dataservice.bill.downloadurl.query');
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