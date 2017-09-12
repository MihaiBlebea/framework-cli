<?php

namespace Framework\Validators;

use Framework\Factory\ValidatorFactory;
use Framework\Router\Request;
use Framework\Injectables\Injector;

class Validator
{
    private $request;

    private $options = null;

    public $errors = array();

    private $validators = [
        "email"   => "Please provide a correct email.",
        "integer" => "Please insert a valid number.",
        "char"    => "This must be composed by letters"
    ];

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function options(array $options = [])
    {
        $this->options = $options;
        return $this;
    }

    public function validate(array $payload)
    {
        foreach($payload as $key => $data)
        {
            $rules = explode("|", $data["rules"]);

            foreach($rules as $rule)
            {
                $validator = ValidatorFactory::build($rule);
                if($validator->validate($data["value"]) == false)
                {
                    $this->errors["error_" . $key] = $this->validators[$rule];
                    continue;
                }
            }
        }
        $this->out();
    }

    public function validateRequest(array $rules)
    {
        $result = array();

        foreach($this->request->getAllPayload() as $index => $value)
        {
            if(array_key_exists($index, $rules))
            {
                $result[$index] = ["value" => $value, "rules" => $rules[$index]];
            }
        }

        $this->validate($result);
    }

    public function out()
    {
        if($this->options["return"] !== null)
        {
            $template = Injector::resolve("Template");
            $template->assign($this->request->getAllPayload());
            $template->assign($this->errors);
            $template->display($this->options["return"]);
            die();
        }

        return $this->errors;
    }
}
