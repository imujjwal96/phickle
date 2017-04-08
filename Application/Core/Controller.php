<?php

namespace Phickle\Core;

use Phickle\Core\Framework\Helper;
use Phickle\Core\Framework\Model;

class Controller
{
    public $View;

    public function __construct(Model $model, Helper $helper)
    {
        $this->View = new View();
    }
}