<?php

namespace Framework\Router;

use Exception;
use Framework\Sessions\PreviousPathSession;

class Request
{
    private $fullUrl;

    private $method;

    private $payload;

    private $trimmedUrl;

    private $urlAsArray = array();

    private $elements;

    public function __construct()
    {
        $this->fullUrl = $this->getUrl();

        // Check if request is GET OR POST
        $this->method = $this->checkRequestMethod();

        // Save DATA from Request
        if($this->method == "GET")
        {
            $this->payload = $this->get();
        } elseif ($this->method == "POST") {
            $this->payload->post();
        } else {
            throw new Exception("Error Processing Request", 1);
        }

        // Parse Full url and cut query
        $this->trimmedUrl = explode('?', $this->fullUrl)[0];

        // Explode URL and save in array
        $this->urlAsArray = $this->explodeUrl($this->trimmedUrl);

        // Calculate elements count
        $this->elements = $this->countElements($this->urlAsArray);
    }

    public function getUrl()
    {
        return ltrim(substr($_SERVER['REQUEST_URI'], strlen(implode('/', array_slice(explode('/', $_SERVER['SCRIPT_NAME']), 0, -1)) . '/') - 1), '/');
    }

    public function checkRequestMethod()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public function get()
    {
        return $_GET;
    }

    public function post()
    {
        $payload = $_POST;
        if(empty($payload))
        {
            $payload = file_get_contents('php://input');
            $payload = json_decode($payload);
        }
        return $payload;
    }

    public function explodeUrl($url)
    {
        return $items = explode("/", $url);
    }

    public function countElements(array $elements)
    {
        return count($elements);
    }

    public function out($element)
    {
        if(array_key_exists($element, $this->payload))
        {
            return $this->payload[$element];
        }
    }

    public function getTrimmedUrl()
    {
        return $this->trimmedUrl;
    }

    public function getArray()
    {
        return $this->urlAsArray;
    }

    public function getMethod()
    {
        return$this->method;
    }

    public function getAllPayload()
    {
        return $this->payload;
    }

    public function getPreviousPath()
    {
        if(isset($_SERVER['HTTP_REFERER']))
        {
            return $_SERVER['HTTP_REFERER'];
        } else {
            return null;
        }
    }
}
