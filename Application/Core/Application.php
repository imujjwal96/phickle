<?php

namespace Phickle\Core;

use Phickle\Core\Framework\Helper;
use Phickle\Core\Framework\Model;
use Phickle\Core\Framework\Route;

class Application
{
    /**
     * @var Model
     */
    private $model;

    /**
     * @var Helper
     */
    private $helper;

    protected $controller;
    protected $method;
    protected $params = array();
    private $controllerName;
    protected $route;

    /**
     * @var \Phickle\Core\Helpers\Config
     */
    private $Config;

    public function __construct()
    {

        $this->helper = new Helper();
        $this->model = new Model();
        $this->route = new Route();
        $this->Config = $this->helper->get('Config');

        $this->parseURL();

        if (!$this->controllerName) {
            $this->controllerName = $this->Config->getSystemConfig('DEFAULT_CONTROLLER');
        }

        if (!$this->method OR (strlen($this->method) == 0)) {
            $this->method = $this->Config->getSystemConfig('DEFAULT_ACTION');
        }

        $this->controllerName = ucwords($this->controllerName) . 'Controller';
        if ($this->route->getRequestMethod() != $_SERVER["REQUEST_METHOD"]) {
            require $this->Config->getSystemConfig('PATH_VIEW') . '403.php';
            return;
        }

        if (file_exists($this->Config->getSystemConfig('PATH_CONTROLLER') . $this->controllerName . '.php')) {
            $this->instantiateController();
            if (method_exists($this->controller, $this->method)) {
                if (!empty($this->params)) {
                    call_user_func_array(array($this->controller, $this->method), $this->params);
                } else {
                    $this->controller->{$this->method}();
                }
            } else {
                require $this->Config->getSystemConfig('PATH_VIEW') . '404.php';
            }
        } else {
            require $this->Config->getSystemConfig('PATH_VIEW') . '404.php';
        }
    }

    public function parseURL()
    {
        if (isset($_GET['url'])) {
            if ($this->route->exists($_GET['url'])) {
                $this->controllerName = $this->route->getController();
                $this->method = $this->route->getMethod();
                $this->params = $this->route->getParams();
            } else {
                require $this->Config->getSystemConfig('PATH_VIEW') . '404.php';
            }
        }
    }

    private function instantiateController()
    {
        require $this->Config->getSystemConfig('PATH_CONTROLLER') . $this->controllerName . '.php';
        $class = 'Phickle\Controllers\\' . $this->controllerName;
        $this->controller = new $class($this->model, $this->helper);
    }
}