<?php

namespace UmutTaymaz\VerimorSMS;

use Illuminate\Support\Arr;

class VerimorSMSMessage
{
    /**
     * The message content.
     *
     * @var string
     */
    public $content = '';

    public static function create($content = '')
    {
        return new static($content);
    }
    /**
     * @param  string  $content
     */
    public function __construct($content = '')
    {
        $this->content = $content;
    }
    /**
     * Set the message content.
     *
     * @param  string  $content
     *
     * @return $this
     */
    public function content($content)
    {
        $this->content = $content;
        return $this;
    }
}
