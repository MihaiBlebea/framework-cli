<?php

namespace Framework\Validators;

class IntegerValidator
{
    public function validate(string $value)
    {
        if(is_numeric($value) !== false)
        {
            return true;
        } else {
            return false;
        }
    }
}
