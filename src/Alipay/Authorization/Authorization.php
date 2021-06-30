<?php

namespace cccdl\ali_sdk\Alipay\Authorization;

use cccdl\ali_sdk\Alipay\BasicAliPay;

/**
 * 获取app授权验证码infoStr
 * 授权服务类
 * Class App
 * @package AliPay
 */
class Authorization extends BasicAliPay
{
    /**
     * App constructor.
     * @param array $options
     */
    public function __construct(array $options)
    {
        parent::__construct($options);
        $this->options->set('pid', $options['pid']);
    }

    /**
     * id_verify=预咨询
     * @param array $options
     * @return mixed
     */
    public function apply(array $options)
    {

        $arr = array_merge([
            'apiname' => 'com.alipay.account.auth',
            'app_id' => $this->options->get('app_id'),
            'app_name' => 'mc',
            'auth_type' => 'AUTHACCOUNT',
            'biz_type' => 'openservice',
            'method' => 'alipay.open.auth.sdk.code.get',
            'pid' => $this->options->get('pid'),
            'product_id' => 'APP_FAST_LOGIN',
            'sign_type' => 'RSA2',
            'target_id' => md5(mt_rand(999, 99999) . time()), //商户标识该次用户授权请求的ID，该值在商户端应保持唯一
        ],$options);

        $infoStr = http_build_query($arr);

        $content = wordwrap($this->trimCert($this->config->get('private_key')), 64, "\n", true);
        $string = "-----BEGIN RSA PRIVATE KEY-----\n$content\n-----END RSA PRIVATE KEY-----";
        if ($this->options->get('sign_type') === 'RSA2') {
            openssl_sign($infoStr, $sign, $string, OPENSSL_ALGO_SHA256);
        } else {
            openssl_sign($infoStr, $sign, $string, OPENSSL_ALGO_SHA1);
        }

        $infoStr .= '&sign=' . base64_encode($sign);
        return $infoStr;

    }

}