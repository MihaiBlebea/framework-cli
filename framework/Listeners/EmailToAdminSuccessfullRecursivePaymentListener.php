<?php

namespace Framework\Listeners;

use Framework\Events\Subject;
use Framework\Emails\SuccessRecursivePaymentToAdminEmail;
use Framework\Interfaces\ListenerInterface;

class EmailToAdminSuccessfullRecursivePaymentListener implements ListenerInterface
{
    public function listen(Subject $subject)
    {
        SuccessRecursivePaymentToAdminEmail::send($subject->getPayload());
    }
}
