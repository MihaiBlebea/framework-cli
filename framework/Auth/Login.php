<?php

namespace Framework\Auth;

use Framework\Sessions\UsernameSession;

class Login
{
    private $session;

    public function __construct(UsernameSession $session)
    {
        $this->session = $session;
    }

    public function isLogin()
    {
        if($this->session->getContent() !== false)
        {
            return true;
        } else {
            return false;
        }
    }

    public function getLoggedUser()
    {
        if($this->isLogin())
        {
            return $this->session->getContent();
        } else {
            return false;
        }
    }

    public function logUser($data)
    {
        $this->session->setContent($data);
    }

    public function logout()
    {
        $this->session->delete();
    }
}
