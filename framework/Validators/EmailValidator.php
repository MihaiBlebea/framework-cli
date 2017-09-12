<?php

namespace Framework\Validators;

class EmailValidator
{
    public function validate(string $value)
    {
        if(strpos($value, '@') !== false)
        {
            return true;
        } else {
            return false;
        }
    }
}
