<?php

namespace UmutTaymaz\VerimorSMS\Exceptions;

class CouldNotSendNotification extends \Exception
{
    public static function serviceRespondedWithAnError($response)
    {
        return new static('Verimor responded with an error: `'.$response.'`');
    }
}
