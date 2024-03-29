<?php

namespace Phickle\Core\Helpers;

class Request
{
    private function getMethod()
    {
        return $_SERVER["REQUEST_METHOD"];
    }

    public function isPost()
    {
        if ($this->getMethod() != "POST") {
            return false;
        }
        return true;
    }

    public function isGet()
    {
        if ($this->getMethod() != "GET") {
            return false;
        }
        return true;
    }

    public function post($key, $trim = false)
    {
        if (isset($_POST[$key])) {
            return ($trim) ? trim(strip_tags($_POST[$key])) : $_POST[$key];
        }
        return false;
    }

    public function get($key)
    {
        if (isset($_GET[$key])) {
            return $_GET[$key];
        }
        return false;
    }

}