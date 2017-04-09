<?php

return [
    'index' => ['Index#index', 'get'],

    'login' => ['Index#showLogin', 'get'],
    'register' => ['Index#showRegister', 'get'],
    'login/action' => ['Index#tryLogin', 'post'],
    'register/action' => ['Index#tryRegister', 'post'],
];