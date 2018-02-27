<?php

namespace UmutTaymaz\VerimorSMS;

use UmutTaymaz\VerimorSMS\CouldNotSendNotification;
use UmutTaymaz\VerimorSMS\MessageWasSent;
use UmutTaymaz\VerimorSMS\SendingMessage;
use Illuminate\Notifications\Notification;

class VerimorSMSChannel
{

    protected $verimorSMSApi;

    public function __construct(VerimorSMSApi $verimorSMSApi)
    {
        $this->verimorSMSApi = $verimorSMSApi;
    }

    /**
     * Send the given notification.
     *
     * @param mixed $notifiable
     * @param \Illuminate\Notifications\Notification $notification
     *
     * @throws UmutTaymaz\VerimorSMS\Exceptions\CouldNotSendNotification
     */
    public function send($notifiable, Notification $notification)
    {
        $to = $notifiable->routeNotificationFor('verimor');

        /*if (empty($to)) {
            //@todo exception for empty recipient
        }*/

        $message = $notification->toVerimor($notifiable);


        $this->verimorSMSApi->send($message, $to);
    }

}
