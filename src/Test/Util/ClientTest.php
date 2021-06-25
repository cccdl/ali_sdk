<?php declare(strict_types=1);

namespace cccdl\ali_sdk\Test\Util;

use cccdl\ali_sdk\Alipay\Util\SystemOauthToken;
use cccdl\ali_sdk\Exceptions\InvalidResponseException;
use cccdl\ali_sdk\Test\TestAccount;
use PHPUnit\Framework\TestCase;

require '../../../vendor/autoload.php';

class ClientTest extends TestCase
{
    public function testSystemOauthToken(): void
    {
        $c = TestAccount::getTestAccount();
        $this->assertIsArray($c);
        $app = new SystemOauthToken($c);
        try{
            $result = $app->apply([
                // 授权方式。支持：1.authorization_code，表示换取使用用户授权码code换取授权令牌access_token。 2.refresh_token，表示使用refresh_token刷新获取新授权令牌。
//                'grant_type' => 'authorization_code',
                // 授权码，用户对应用授权后得到。本参数在 grant_type 为 authorization_code 时必填；为 refresh_token 时不填。
                'code' => '99b3516d341442c187e87209f196YD79',
            ]);
        } catch (InvalidResponseException $e) {
           print_r($e->raw);

            $this->assertSame('10000', $e->raw['error_response']['code']);
            $this->assertSame('Success', $e->raw['error_response']['msg']);
        }

    }
}
