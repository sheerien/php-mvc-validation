<?php

use Dotenv\Dotenv;
use Afkar\Test\Support\Config;
use Afkar\Test\Validation\Rules\AlfaNumericalRule;
use Afkar\Test\Validation\Validator;
use Afkar\Test\Validation\Rules\RequiredRule;

/*
|-------------------------------------------------
| Minimal Mvc PHP Framework
|-------------------------------------------------
|
|@author Sherieen Bassem <sherieenbassem@gmail.com>
*/

/*
|-------------------------------------------------
| Register the autoloader
|-------------------------------------------------
|
| Load the autoloader that will generated classes that will be used.
*/

require_once realpath(dirname(__DIR__ ). '/vendor/autoload.php');

/*
|-------------------------------------------------
| Bootstrap the Application
|-------------------------------------------------
|
| Bootstrap the application and do action from framework
*/

require_once realpath(dirname(__DIR__ ). '/bootstrap/app.php');

/*
|-------------------------------------------------
| Run the Application
|-------------------------------------------------
|
| Handle the request and send response
*/
Application::run();

$env = Dotenv::createImmutable(base_path());

$env->load();

$arr = [
    'db' => [
        'connection' => [
            'host' => 'localhost',
        ]
    ]
];

$validator = new Validator();

$validator->setRules([
    // 'username' => 'required|alnum|between:5,7',
    // 'email' => ['required', 'alnum', 'email'],
    'password' => 'required|confirmed',
    'password_confirmation' => 'required'
    
]);
// $validator->setAliases([
//     'username' => 'user name',
//     'email' => 'sherien'
// ]);
$validator->make([
    // 'username' => '',
    // 'email' => 'em$em.com',
    'password' => 'abc',
    'password_confirmation' => 'ab',
]);

dump($validator->errors());

// dump(provider("validation_provider"));