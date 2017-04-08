<?php

namespace Phickle\Core\Helpers;

class Redirect
{
    private $Config;

    public function __construct()
    {
        $this->Config = new Config();
    }

    public function to($path)
    {
        header("location: " . $this->Config->getSystemConfig('URL') . $path);
    }
}
