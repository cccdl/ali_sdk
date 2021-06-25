<?php
namespace cccdl\ali_sdk\Alipay\Member;

use cccdl\ali_sdk\Alipay\BasicAliPay;
use cccdl\ali_sdk\Exceptions\InvalidResponseException;
use cccdl\ali_sdk\Exceptions\LocalCacheException;

/**
 * 实名证件信息比对验证预咨询
 * Class App
 * @package AliPay
 */
class CertdocCertverifyPreconsult extends BasicAliPay
{
    /**
     * App constructor.
     * @param array $options
     */
    public function __construct(array $options)
    {
        parent::__construct($options);
        $this->options->set('method', 'alipay.user.certdoc.certverify.preconsult');
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