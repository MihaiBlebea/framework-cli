<?php

namespace Framework\Events;

class Subject
{
    private $sendDate;

    private $payload;

    private $sender;

    public function __construct($sendDate, $payload, $sender)
    {
        $this->sendDate = $sendDate;
        $this->payload = $payload;
        $this->sender = $sender;
    }

    public function getSendDate()
    {
        return $this->sendDate;
    }

    public function getPayload()
    {
        return $this->payload;
    }

    public function getSender()
    {
        return $this->sender;
    }
}
