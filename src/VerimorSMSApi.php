<?php
/**
 * Created by PhpStorm.
 * User: umuttaymaz
 * Date: 27.02.2018
 * Time: 15:44.
 */

namespace UmutTaymaz\VerimorSMS;

use UmutTaymaz\VerimorSMS\Exceptions\CouldNotSendNotification;

class VerimorSMSApi
{
    /** @var string */
    protected $apiUrl = 'http://sms.verimor.com.tr/v2/send.json';

    protected $username;

    protected $password;

    protected $header;

    public function __construct()
    {
        $this->username = env('VERIMOR_USERNAME');
        $this->password = env('VERIMOR_PASSWORD');
        $this->header = env('VERIMOR_HEADER');
    }

    /**
     * @param $message
     * @param $phones
     * @throws CouldNotSendNotification
     */
    public function send($message, $phone)
    {
        $sms_msg = [
            'username' => $this->username,
            'password' => $this->password,
            'source_addr' => $this->header,
            /*"valid_for" => "48:00",
            "send_at" => "2015-02-20 16:06:00",
            "datacoding" => "0",*/
            'custom_id' => uniqid(),
            'messages' => [
                [
                    'msg' => $message->content,
                    'dest' => $phone,
                ],
            ],
        ];

        try {
            $ch = curl_init($this->apiUrl);
            curl_setopt_array($ch, [
                CURLOPT_POST => true,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
                CURLOPT_POSTFIELDS => json_encode($sms_msg),
            ]);
            curl_exec($ch);
            curl_getinfo($ch, CURLINFO_HTTP_CODE);
        } catch (\Exception $exception) {
            throw CouldNotSendNotification::serviceRespondedWithAnError($exception);
        }
    }
}
