<?php

namespace Phickle\Core;

use Phickle\Core\Helpers\Config;

class View
{
    private $Config;

    public function __construct()
    {
        $this->Config = new Config();
    }

    public function render($filename, $data = null)
    {
        if ($data) {
            foreach ($data as $key => $value) {
                $this->{$key} = $value;
            }
        }

        require $this->Config->getSystemConfig('PATH_VIEW') . 'templates/header.php';
        require $this->Config->getSystemConfig('PATH_VIEW') . $filename . '.php';
        require $this->Config->getSystemConfig('PATH_VIEW') . 'templates/footer.php';
    }

    public function renderWithoutHeaderAndFooter($filename, $data = null)
    {
        if ($data) {
            foreach ($data as $key => $value) {
                $this->{$key} = $value;
            }
        }
        require $this->Config->getSystemConfig('PATH_VIEW') . $filename . '.php';
    }



    public function renderJSON($data, $code)
    {
        http_response_code($code);
        header("Content-Type: application/json");
        echo json_encode($data);
    }
}