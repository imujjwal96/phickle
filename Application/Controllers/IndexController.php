<?php

namespace Phickle\Controllers;

use Phickle\Core\Controller;
use Phickle\Core\Framework\Helper;
use Phickle\Core\Framework\Model;

class IndexController extends Controller
{
    /**
     * @var \Phickle\Core\Helpers\Redirect
     */
    private $Redirect;

    /**
     * @var \Phickle\Core\Helpers\Request
     */
    private $Request;

    /**
     * @var \Phickle\Core\Helpers\Session
     */
    private $Session;

    /**
     * @var \Phickle\Models\User
     */
    private $user;

    public function __construct(Model $model, Helper $helper)
    {
        $this->user = $model->get('User');

        $this->Session = $helper->get('Session');
        $this->Request = $helper->get('Request');
        $this->Redirect = $helper->get('Redirect');

        parent::__construct($model, $helper);
    }

    public function index()
    {
        $this->View->render('index/index');
    }

    public function showLogin()
    {
        $this->View->render('index/login');
    }

    public function showRegister()
    {
        $this->View->render('index/register');
    }

    public function tryLogin()
    {
        $username = $this->Request->post('username');
        $password = $this->Request->post('password');

        if ($this->user->checkPassword($username, $password)) {
            $this->Session->add('user_name', $username);
            $this->Redirect->to('/index');
        }
    }

    public function tryRegister()
    {
        $username = $this->Request->post('username');
        $password = $this->Request->post('password');

        $this->user->create($username, $password);
        $this->Redirect->to('/login');
    }
}