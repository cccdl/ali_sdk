<?php

namespace cccdl\ali_sdk\Test;


class TestAccount
{
    public static function getTestAccount(): array
    {
        return [
            'appid' => '请填写您的AppId',
//            'appid' => '',

            //支付宝公钥
            'public_key' => '请填写您的支付宝公钥',
//            'public_key' => '',

            //应用私钥
            'private_key' => '请填写您的应用私钥',
//            'private_key' => '',

            //回调地址
            'notify_url' => '请填写您的回调地址',
//            'notify_url' => '',
        ];
    }

}