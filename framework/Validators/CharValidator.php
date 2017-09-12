<?php

namespace Framework\Validators;

class CharValidator
{
    public function validate(string $value)
    {
        if(ctype_alpha($value) !== false)
        {
            return true;
        } else {
            return false;
        }
    }
}
