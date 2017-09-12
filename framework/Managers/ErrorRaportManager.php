<?php

namespace Framework\Managers;

use Framework\Interfaces\ManagerInterface;
use Framework\Factory\EventFactory;
use Framework\Factory\ListenerFactory;

class ErrorRaportManager implements ManagerInterface
{
    public function run($payload)
    {
        $event         = $this->createEvent();
        $listenerLog   = $this->createLogListener();
        $listenerEmail = $this->createEmailListener();

        return $event->attach($listenerLog)->attach($listenerEmail)->trigger($payload);
    }

    private function createEvent()
    {
        return EventFactory::build("error", "framework");
    }

    private function createLogListener()
    {
        return ListenerFactory::build("LogError","framework");
    }

    private function createEmailListener()
    {
        return ListenerFactory::build("EmailErrorToAdmin","framework");
    }
}
