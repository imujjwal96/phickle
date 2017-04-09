<?php

namespace Phickle\Core\Framework;

class Helper
{
    private static $helpers;
    private $list = [
        'Config',
        'DatabaseFactory',
        'Redirect',
        'Request',
        'Session'
    ];
    private $namespace = 'Phickle\Core\Helpers\\';

    public function __construct()
    {
        foreach ($this->list as $helper) {
            $helper = $this->namespace . $helper;
            self::$helpers[$helper] = new $helper;
        }
    }

    public function get($helper)
    {
        if (!in_array($helper, $this->list)) {
            return false;
        }

        $helper = $this->namespace . $helper;
        if (!self::$helpers[$helper]) {
            self::$helpers[$helper] = new $helper;
        }
        return self::$helpers[$helper];
    }
}