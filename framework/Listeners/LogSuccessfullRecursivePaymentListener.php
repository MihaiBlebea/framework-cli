<?php

namespace Framework\Listeners;

use Framework\Events\Subject;
use Framework\Log\PaymentLogger;
use Framework\Interfaces\ListenerInterface;

class LogSuccessfullRecursivePaymentListener implements ListenerInterface
{
    public function listen(Subject $subject)
    {
        PaymentLogger::log($subject->getPayload());
    }
}
