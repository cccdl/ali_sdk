<?php declare(strict_types=1);

namespace cccdl\ali_sdk\Test\Member;

use cccdl\ali_sdk\Alipay\Member\CertdocCertverifyPreconsult;
use cccdl\ali_sdk\Test\TestAccount;
use PHPUnit\Framework\TestCase;

require '../../../vendor/autoload.php';

class ClientTest extends TestCase
{
    public function testCertdocCertverifyPreconsult(): void
    {
        $c = TestAccount::getTestAccount();
        $this->assertIsArray($c);
        $app = new CertdocCertverifyPreconsult($c);
        $result = $app->apply([

            // 真实姓名
            'user_name' => '',

            // 证件类型。暂仅支持 IDENTITY_CARD （身份证）。
            'cert_type' => 'IDENTITY_CARD',

            // 证件号
            'cert_no' => '',
        ]);

        print_r($result);
        $this->assertIsArray($result);
        $this->assertArrayHasKey('verify_id', $result);
        $this->assertArrayHasKey('code', $result);
        $this->assertArrayHasKey('msg', $result);
    }
}
