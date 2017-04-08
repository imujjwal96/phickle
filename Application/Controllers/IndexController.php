<?php

namespace Phickle\Controllers;

use Phickle\Core\Controller;
use Phickle\Core\Framework\Helper;
use Phickle\Core\Framework\Model;

class IndexController extends Controller
{
    public function __construct(Model $model, Helper $helper)
    {
        parent::__construct($model, $helper);
    }

    public function index()
    {
        $this->View->render('index/index');
    }
}