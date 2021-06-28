<?php


namespace cccdl\ali_sdk\Util;


use cccdl\ali_sdk\Exceptions\cccdlException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

/**
 * 请求服务类
 * Trait Request
 * @package cccdl\ali_sdk\Util
 */
trait Request
{
    /**
     * post请求
     * @return mixed
     * @throws GuzzleException
     * @throws cccdlException
     */
    protected function post()
    {
        $client = new Client([
            'timeout' => 10,
        ]);

        $response = $client->post($this->gateway, ['form_params' => $this->options->get()]);

        if ($response->getStatusCode() != 200) {
            throw new cccdlException('请求失败: ' . $response->getStatusCode());
        }

        return json_decode($response->getBody(), true);

    }
}
