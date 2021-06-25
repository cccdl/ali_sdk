<?php

namespace cccdl\ali_sdk;


use cccdl\ali_sdk\Ali\App;
use cccdl\ali_sdk\Ali\Bill;
use cccdl\ali_sdk\Ali\Pos;
use cccdl\ali_sdk\Ali\Scan;
use cccdl\ali_sdk\Ali\Trade;
use cccdl\ali_sdk\Ali\Transfer;
use cccdl\ali_sdk\Ali\Wap;
use cccdl\ali_sdk\Ali\Web;
use cccdl\ali_sdk\Util\DataArray;
use cccdl\ali_sdk\Exceptions\InvalidInstanceException;

/**
 * 加载缓存器
 *
 * ----- AliPay ----
 * @method App AliPayApp($options) static 支付宝App支付网关
 * @method Bill AliPayBill($options) static 支付宝电子面单下载
 * @method Pos AliPayPos($options) static 支付宝刷卡支付
 * @method Scan AliPayScan($options) static 支付宝扫码支付
 * @method Trade AliPayTrade($options) static 支付宝标准接口
 * @method Transfer AliPayTransfer($options) static 支付宝转账到账户
 * @method Wap AliPayWap($options) static 支付宝手机网站支付
 * @method Web AliPayWeb($options) static 支付宝网站支付
 *
 */
class Ali
{
    /**
     * 定义当前版本
     * @var string
     */
    const VERSION = '1.2.30';

    /**
     * 静态配置
     * @var DataArray
     */
    private static $config;

    /**
     * 设置及获取参数
     * @param array $option
     * @return array
     */
    public static function config($option = null)
    {
        if (is_array($option)) {
            self::$config = new DataArray($option);
        }
        if (self::$config instanceof DataArray) {
            return self::$config->get();
        }
        return [];
    }

    /**
     * 静态魔术加载方法
     * @param string $name 静态类名
     * @param array $arguments 参数集合
     * @return mixed
     * @throws InvalidInstanceException
     */
    public static function __callStatic($name, $arguments)
    {
        if (substr($name, 0, 6) === 'WeChat') {
            $class = 'WeChat\\' . substr($name, 6);
        } elseif (substr($name, 0, 6) === 'WeMini') {
            $class = 'WeMini\\' . substr($name, 6);
        } elseif (substr($name, 0, 6) === 'AliPay') {
            $class = 'AliPay\\' . substr($name, 6);
        } elseif (substr($name, 0, 5) === 'WePay') {
            $class = 'WePay\\' . substr($name, 5);
        }
        if (!empty($class) && class_exists($class)) {
            $option = array_shift($arguments);
            $config = is_array($option) ? $option : self::$config->get();
            return new $class($config);
        }
        throw new InvalidInstanceException("class {$name} not found");
    }

}
