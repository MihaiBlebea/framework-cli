<?php

namespace Framework\Events;

use Framework\Interfaces\EventInterface;
use Framework\Events\Subject;

class RecursivePaymentSuccessEvent implements EventInterface
{
    private $listeners = array();

    private $subject;

    public function attach($listener)
    {
        array_push($this->listeners, $listener);
        return $this;
    }

    public function trigger($payload)
    {
        $date = date('Y-m-d H:i:s');
        $subject = new Subject($date, $payload, __CLASS__);

        $this->subject = $subject;
        $this->notify();
    }

    public function notify()
    {
        foreach($this->listeners as $index => $listener)
        {
            $listener->listen($this->subject);
        }
    }
}
