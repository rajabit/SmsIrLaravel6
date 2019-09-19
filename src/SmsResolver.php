<?php

namespace MahdiIDea\SmsIrLaravel;

use MahdiIDea\SmsIrLaravel6\Classes\SmsIR_SendMessage;

class SmsResolver
{
    private $apiKey, $secretKey;

    public function __construct()
    {
        $this->apiKey = env("SMS_IR_API_KEY");
        $this->secretKey = env("SMS_IR_SECRET_KEY");
    }

    public static function instance(): SmsResolver
    {
        return (new SmsResolver);
    }

    public function send($phone, $message, $send_at = null)
    {
        if ($send_at == null) $send_at = date("Y-m-d\TH:i:s");
        try {

            $LineNumber = "1";
            $SmsIR_SendMessage = new SmsIR_SendMessage($this->apiKey, $this->secretKey, $LineNumber);
            $SendMessage = $SmsIR_SendMessage->SendMessage($phone, $message, $send_at);
            var_dump($SendMessage);

        } catch (\Exception $e) {
            echo 'Error SendMessage : ' . $e->getMessage();
        }
    }
}