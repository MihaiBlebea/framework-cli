<?php

namespace Framework\Listeners;

use Framework\Events\Subject;
use Framework\Log\ErrorLogger;
use Framework\Interfaces\ListenerInterface;

class LogErrorListener implements ListenerInterface
{
    public function listen(Subject $subject)
    {
        ErrorLogger::log([
            "date" => $subject->getSendDate(),
            "message" => $subject->getPayload()
        ]);
    }
}
