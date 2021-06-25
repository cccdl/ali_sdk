<?php


namespace cccdl\ali_sdk\Ali;


use cccdl\ali_sdk\Exceptions\InvalidResponseException;
use cccdl\ali_sdk\Exceptions\LocalCacheException;

/**
 * 支付宝标准接口
 * Class Trade
 * @package AliPay
 */
class Trade extends BasicAliPay
{

    /**
     * 设置交易接口地址
     * @param string $method
     * @return $this
     */
    public function setMethod(string $method): Trade
    {
        $this->options->set('method', $method);
        return $this;
    }

    /**
     * 获取交易接口地址
     * @return string
     */
    public function getMethod()
    {
        return $this->options->get('method');
    }

    /**
     * 设置接口公共参数
     * @param array $option
     * @return Trade
     */
    public function setOption(array $option = []): Trade
    {
        foreach ($option as $key => $vo) {
            $this->options->set($key, $vo);
        }
        return $this;
    }

    /**
     * 获取接口公共参数
     * @return array|string|null
     */
    public function getOption()
    {
        return $this->options->get();
    }

    /**
     * 执行通过接口
     * @param array $options
     * @return array|boolean
     * @throws InvalidResponseException
     * @throws LocalCacheException
     */
    public function apply(array $options)
    {
        return $this->getResult($options);
    }
}