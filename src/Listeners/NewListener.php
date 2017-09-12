<?php

namespace App\Listeners;

use Framework\Events\Subject;
use Framework\Interfaces\ListenerInterface;

class NewListener implements ListenerInterface
{
    public function listen(Subject $subject)
    {
        //Do stuff
        dd([
            "payload"   => $subject->getPayload(),
            "send-date" => $subject->getSendDate(),
            "sender"    => $subject->getSender()
        ]);
    }
}
