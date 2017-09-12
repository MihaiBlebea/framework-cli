<?php

namespace Framework\Listeners;

use Framework\Events\Subject;
use Framework\Interfaces\ListenerInterface;
use Framework\Emails\ErrorToAdminEmail;

class EmailErrorToAdminListener implements ListenerInterface
{
    public function listen(Subject $subject)
    {
        ErrorToAdminEmail::send($subject->getPayload());
    }
}
