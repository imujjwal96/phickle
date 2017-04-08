<?php
return [
    'URL' => 'http://' . $_SERVER['HTTP_HOST'] . str_replace('public', '', dirname($_SERVER['SCRIPT_NAME'])),

    'PATH_CONTROLLER' => realpath(dirname(__FILE__).'/../../') . '/Application/Controllers/',
    'PATH_VIEW' => realpath(dirname(__FILE__).'/../../') . '/Application/Views/',

    'DEFAULT_CONTROLLER' => 'index',
    'DEFAULT_ACTION' => 'index',
];