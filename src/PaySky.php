<?php


namespace PaySky\Payment;

use Carbon\Carbon;


class PaySky
{
    public function makePayment($amount , $merchRef)
    {
        $timeNow = Carbon::now()->format('D, d M Y H:i:s \G\M\T');
        return [
            "paymentMethodFromLightBox"=> 2,
            "MID" =>  env("PaySky_MerchantId"),
            "TID" => env("PaySky_TerminalId"),
            "AmountTrxn" => $amount,
            "MerchantReference" =>  $merchRef,
            "TrxDateTime"=> $timeNow,
            "SecureHash"=> $this->generateSecureHash($timeNow, $amount , $merchRef )
        ];
    }

    protected  function generateSecureHash($time , $amount , $merchRef )
    {
        $merchantId =  env("PaySky_MerchantId");
        $terminalId =  env("PaySky_TerminalId");
        $secretKey =  env("PaySky_MerchantSecretKey");
        $hashing = "Amount=$amount&DateTimeLocalTrxn=$time&MerchantId=$merchantId&MerchantReference=$merchRef&TerminalId=$terminalId";
        return strtoupper ( hash_hmac('sha256', $hashing , $this->hexToStr($secretKey))) ;
    }

    protected function hexToStr($hex)
        {
            $string = '';
            for ($i = 0; $i < strlen($hex) - 1; $i += 2) {
                $string .= chr(hexdec($hex[$i] . $hex[$i + 1]));
            }
            return $string;
        }

}
