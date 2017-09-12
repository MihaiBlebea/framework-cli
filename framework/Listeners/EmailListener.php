<?php

namespace Framework\Listeners;

use Framework\Events\Subject;
use Framework\Interfaces\ListenerInterface;

class EmailListener implements ListenerInterface
{
    public function listen(Subject $subject)
    {
        //Do stuff
        echo $subject->getPayload() . "<br />";
        echo $subject->getSendDate() . "<br />";
        echo $subject->getSender() . "<br />";
    }
}
