<?php

namespace cccdl\ali_sdk\Test;


class TestAccount
{
    public static function getTestAccount(): array
    {
        return [
//            'appid' => '请填写您的AppId',
            'appid' => '2021002151693364',

            //支付宝公钥
//            'public_key' => '请填写您的支付宝公钥',
            'public_key' => 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAnccmoRbrUnlEjTOIEOo2/oaz5JoAlQdUwy9ULxqv7IceR7IxW6ETWoU53rpBTk0m1VCxYTjXoVqH/XMXQ1KPZmZynARpJuS3PEeIt0cKzhBwZEsdfexT6TXffs+LRK3zq2kR4w7kUmglTk0iefsXA2JNJkJLQkfGeCUwbheK0TBZkrOvFRNjaYSySCCyjENDSUqvML2EGhqgM60NQpMXTwWGGCgMKvc5FN6ilN/NsZpZYKqmYlq/C7LD9YdpZE4PTz7NOt8ps1wjl2kKVIn0mtDpgXAs2KgBIBl+ghWweq+5zHSNrIwHMYhdlHUdwNtkTOa6E/Acqrb9KSvH5PC2yQIDAQAB',

            //应用私钥
//            'private_key' => '请填写您的应用私钥',
            'private_key' => 'MIIEpAIBAAKCAQEAhKVSSqI88j1y9f5XSGRNop4I5O6BaIIX7nyyGlaUcNu1xeKJ7cyOt94r4COSnnig47Jo0jInUV0/bZsVXMxqtk/yNbaV491TIHUIQdUBJQfjTxqGBZITVopd0BxDcz/buFXku4jFziUjQ6Qyfu7jJflfj32m70g0l2evgnYVOpK2ldv8aBeS+rIWALgbNofz6TFLUXGG6FsZnbTN/hWANejIsgqISMxTEpegPT7h3JUpypYbQK9zN7mxiEL7iU4X3RgEBfYvBYpUzhVj1wwv8OjZ8+Sj+IwN6VEZBMBqWBuBnLQOI9erZGE4XGSc5SDYf8Bi6S9d3VQS9J3EnwmfnwIDAQABAoIBABGq12gbbdSx/JLpOoTo3zJOrE6ZueDKmxdnwm0hpQnXKcHep5Jl0YiJ7fwfoNK8rGlHhRCiH3yF2AHoSxMeIwR/Z3piBFriSsUi8WObVFizUUJi/QDW8P5w1Yf3i8BY/BH0Vs/nqrkHV0gWIaeod9bB/Ulmagqq6l5UMBtHURKI8L9egNQ305xOsA4NV7bqIvWo78ZRneOfumJ/5lfmOZTmkIXfFOzQNvhuCbTD0ICkpYPOxTRJHJRAIBBltPCTePtW59CKzyQ5J0kIeb3uHYtjmfQyguZowCbuta4oZ3fzi1sPj7oPZXR52b3tns0R/bg5hGVEbY8Qz5YBWmkvxwkCgYEAyfI3QQavP5KrJqkdi8T86DrHSWuq5LKVEcE02JvfFeI+joVe21d5Q1kX6JrnzmBofhyw0Wethm+2Hrlf3aoYpxTYlvbvIKTdZWBa0aAFi74J9FGjdnsZ+2kgmWJrNIX/1CAYDoWuY9DY2nzNd4GCCADfvouyBoMGKP5QogdFJNMCgYEAqCZ+3UMQSiKKmtty25H7186PYyPhUMounMejviLvuM24ymT9teuDdUvX0C/jjBEB4IsiWRirFw+cctrrDffU78ajVyNNza4e8h8Mz+h9sn7ppnBa1iAqO5GOLpslJ0OL7zio8Cxd6Et+zK3mIg4MeeoXjegYwL3NQ6atyVVVyoUCgYEAppGK0a/ZzO4FDZZgMHECyenxhrWv94L1QffCxweKMlqyjoujeffkpZBPECT1HlyW066GibKihkiORzlPwV4Th3zCSYLUKnDRzFR1lIIREPpm64aK9acD/0LvCJUNJ/1+zlDKhu/sr5gLxes67l98CW3vHxPKe2SHKDjb+UlV1tECgYEAh2doZXhpl6k0//qTBSkLKf8WC/mKqOoGmw1QV/3+GEzg72pfu6zJER1fzi+iBtpzLoQbxq9MpqdVjk+nVHorqGHGipbNQkFifgpu4MUQ4zm7oOF85EzGdW2Clxkr0/BasOppb+3qOPMCSoQGe4nglhPhn840kJDGyCFidGwZR5kCgYBKfYT/Bf35j+oFk+KBHYly4FexN99v646xEE1z5DUM7K2wvlJ5J1XjeYn9juLc1HFtQANNLJa1kdptuQ5hS1/wppuNbP0gc2ZkDaU4RZ9Ok1nLoYf5irWRjQaSZ9MEK9L1xPJ/0oke9PrnaAX1OZee+7sgIrAn7N89OV1Knc1Kvg==',

            //回调地址
//            'notify_url' => '请填写您的回调地址',
            'notify_url' => 'https://www.moyoucp.com/api/alipay/callback',
        ];
    }

}