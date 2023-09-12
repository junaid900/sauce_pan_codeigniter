<?php

class DD
{
    private $baseUri;

    private $platCode;

    private $orgCode;

    private $authCode;

    private $privateKey;

    public function __construct($baseUri, $platCode, $orgCode, $authCode, $privateKey)
    {
        $this->baseUri = $baseUri;
        $this->platCode = $platCode;
        $this->orgCode = $orgCode;
        $this->authCode = $authCode;
        $this->privateKey = openssl_pkey_get_private($this->formatterKey($privateKey));
    }

    /**
     * 调用获取单商品开票二维码接口
     * @param $amount 金额
     * @return mixed
     * @throws Exception
     */
    public function getQrCode($amount, $orderInfo = '')
    {
        $ret =  $this->call('/openApi/getQrcode.ddj', [
            'serialNo' => sprintf("%s%s%s", $this->platCode, $this->str_random(3), $orderNo = number_format(microtime(true) * 1000, 0, '', '')),
            'amount' => $amount = sprintf("%.2f", $amount),
            'orderNo' => $orderNo,
            'orderInfo' => $orderInfo ?: sprintf("消费日期：%s\\n单号:%s\\n金额：%s", $date = date("Y-m-d H:i:s"), $orderNo, $amount),
            'orderTime' => $date,
        ]);
//         $ret =  $this->call('/fapiao/openApi/itemsQrcode.ddj', [
//         		'serialNo' => sprintf("%s%s%s", $this->platCode, $this->str_random(3), $orderNo = number_format(microtime(true) * 1000, 0, '', '')),
//         		'amount' => $amount = sprintf("%.2f", $amount),
//         		'orderNo' => $orderNo,
//         		'orderInfo' => $orderInfo ?: sprintf("消费日期：%s\\n单号:%s\\n金额：%s", $date = date("Y-m-d H:i:s"), $orderNo, $amount),
//         		'orderTime' => $date,
//         ]);

        if(isset($ret['contentMsgDecode']) && !empty($ret['contentMsgDecode'])){
            $ret['contentMsgDecode']['orderNo'] = $orderNo;
        }
        return $ret;
    }


    /**
     * 获取开票信息
     * @param $orderNo 小票单号
     * @return mixed
     * @throws Exception
     */
    public function queryInvoice($orderNo)
    {
        return $this->call('/openApi/queryInvoice.ddj', [
            'orderNo' => $orderNo,
        ]);
    }


    private function call($path, $args)
    {
        $req = json_encode([
            'platCode' => $this->platCode,
            'invokeTime' => date("Y-m-d H:i:s"),
            'contentMsg' => $this->encrypt(json_encode(array_merge([
                'orgCode' => $this->orgCode,
                'authCode' => $this->authCode,
            ], $args))),
        ]);
        $data = json_decode($this->post($this->baseUri . $path, $req, ['Content-Type:application/json']), true);
        $data['contentMsgDecode'] = json_decode($this->decrypt($data['contentMsg']), true);
        return $data;
    }


    /**
     * 请求
     * @param $url
     * @param $data
     * @param null $header
     * @return bool|string
     * @throws Exception
     */
    private function post($url, $data, $header = null)
    {
        $ch = curl_init();
        if ($header) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $res = curl_exec($ch);
        if (!empty(curl_errno($ch))) {
            throw new \Exception(curl_error($ch), 500);
        }
        curl_close($ch);
        return $res;
    }


    public function __destruct()
    {
        if ($this->privateKey) {
            openssl_free_key($this->privateKey);
        }
    }

    /**
     * 加密
     * @param $data
     * @return string
     */
    private function encrypt($data)
    {
        return base64_encode(array_reduce(str_split($data, 117), function ($carry, $item) {
            openssl_private_encrypt($item, $nil, $this->privateKey);
            return $carry . $nil;
        }, ''));
    }


    /**
     * 解密
     * @param $data
     * @return array|string
     */
    private function decrypt($data)
    {
        return array_reduce(str_split(base64_decode($data), 128), function ($carry, $item) {
            openssl_private_decrypt($item, $nil, $this->privateKey);
            return $carry . $nil;
        }, '');
    }


    /**
     * 格式化私钥
     * @param $privateKey string 公钥
     * @return string
     */
    private function formatterKey($privateKey)
    {
        return "-----BEGIN RSA PRIVATE KEY-----" . PHP_EOL . chunk_split($privateKey, 64, PHP_EOL) . "-----END RSA PRIVATE KEY-----";
    }



    private function str_random($length = 16) {
        $pool = '0123456789abcdefghijklmnopqrstuvwxyz';
        return substr(str_shuffle(str_repeat($pool, 5)), 0, $length);
    }

}