<?php

namespace Framework\Sessions;

class Session
{
    public $sessionID;

    public function __construct()
    {
        if($this->globalSessionIsSet() == false)
        {
            $this->startSession();
        }
    }

    public function globalSessionIsSet()
    {
        return isset($_SESSION);
    }

    public function sessionIsSet()
    {
        return isset($_SESSION[$this->sessionID]);
    }

    public function startSession()
    {
        return session_start();
    }

    public function getContent()
    {
        if($this->sessionIsSet())
        {
            if($_SESSION[$this->sessionID] !== null && $_SESSION[$this->sessionID] !== "")
            {
                return $_SESSION[$this->sessionID];
            } else {
                return false;
            }
        }
    }

    public function setContent($payload)
    {
        $_SESSION[$this->sessionID] = $payload;
    }

    public function delete()
    {
        if(isset($_SESSION[$this->sessionID]))
        {
            unset($_SESSION[$this->sessionID]);
        }
    }
}
