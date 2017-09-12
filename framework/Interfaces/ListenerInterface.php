<?php

namespace Framework\Interfaces;

use Framework\Events\Subject;

interface ListenerInterface
{
    public function listen(Subject $subject);
}
