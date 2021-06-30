# 支付宝 API SDK for PHP  !

### 主要新特性

* 支付宝API SDK FOR PHP
* 简化使用方法
* 调用简单，统一原样返回
* 可执行单元测试

### 更新日志

- 1.0.0 增加 “换取授权访问令牌”、“换取授权访问令牌”，优化了请求调用方式
- 1.1.0 增加 “实名证件信息比对验证咨询”
- 1.2.0 增加 “获取移动app端使用的授权参数infoStr”

## 安装

> 运行环境要求PHP7.1+。

```shell
$ composer require cccdl/ali_sdk
```

### 接口对应文件

| 文件               |  说明      |
| ------------------|------------|
| Alipay\Member\CertdocCertverifyPreconsult.php  | 实名证件信息比对验证预咨询 |
| Alipay\Member\CertdocCertverifyConsult.php  | 实名证件信息比对验证咨询 |
| Alipay\Util\SystemOauthToken.php  | 换取授权访问令牌 |
| Alipay\Authorization\Authorization.php  | 获取移动app端使用的授权参数infoStr |


### 快速使用

在您开始之前，您需要注册网易云信并获取您的[凭证](https://opendocs.alipay.com/apis/api_9/alipay.system.oauth.token)。

```php
<?php

use cccdl\ali_sdk\Alipay\Util\SystemOauthToken;

$config = [
    'appid' => '请填写您的AppId',
    //支付宝公钥
    'public_key' => '请填写您的支付宝公钥',
    //应用私钥
    'private_key' => '请填写您的应用私钥',
    //回调地址
    'notify_url' => '请填写您的回调地址',
     //获取地址 https://openhome.alipay.com/platform/keyManage.htm?keyType=partner 合作伙伴身份pid
    'pid' => '请填写合作伙伴身份pid',
];
$app = new SystemOauthToken($config);
$result = $app->apply([
    // 授权方式。支持：1.authorization_code，表示换取使用用户授权码code换取授权令牌access_token。 2.refresh_token，表示使用refresh_token刷新获取新授权令牌。
    'grant_type' => 'authorization_code',
    // 授权码，用户对应用授权后得到。本参数在 grant_type 为 authorization_code 时必填；为 refresh_token 时不填。
    'code' => '',
]);
```

## 文档

[支付宝api文档](https://opendocs.alipay.com/apis)
[支付宝api开发指南](https://opendocs.alipay.com/open/200)
[支付宝api开放能力](https://opendocs.alipay.com/apis/01da3s)

## 问题

[提交 Issue](https://github.com/cccdl/ali_sdk/issues)，不符合指南的问题可能会立即关闭。

## Contributing

You can contribute in one of three ways:

1. File bug reports using the [issue tracker](https://github.com/cccdl/ali_sdk/issues).
2. Answer questions or fix bugs on the [issue tracker](https://github.com/cccdl/ali_sdk/issues).
3. Contribute new features or update the wiki.

_The code contribution process is not very formal. You just need to make sure that you follow the PSR-0, PSR-1, and
PSR-2 coding guidelines. Any new code contributions must be accompanied by unit tests where applicable._

## License

MIT
