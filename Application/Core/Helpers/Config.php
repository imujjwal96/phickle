<?php

namespace Phickle\Core\Helpers;

class Config
{
    public $systemConfig;
    public $appConfig;

    public function getSystemConfig($key)
    {
        if (!$this->systemConfig) {

            $config_file = '../Application/Config/system.config.php';

            if (!file_exists($config_file)) {
                return false;
            }

            $this->systemConfig = require $config_file;
        }

        return $this->systemConfig[$key];
    }

    public function getAppConfig($key)
    {
        if (!$this->appConfig) {

            $config_file = '../Application/Config/app.config.php';

            if (!file_exists($config_file)) {
                return false;
            }

            $this->appConfig = require $config_file;
        }

        return $this->appConfig[$key];
    }
}