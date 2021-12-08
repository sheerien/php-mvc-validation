<?php

use Afkar\Test\Validation\Rules\MaxRule;
use Afkar\Test\Validation\Rules\EmailRule;
use Afkar\Test\Validation\Rules\BetweenRule;
use Afkar\Test\Validation\Rules\RequiredRule;
use Afkar\Test\Validation\Rules\ConfirmedRule;
use Afkar\Test\Validation\Rules\AlfaNumericalRule;

return [

    'max' => MaxRule::class,
    'required' => RequiredRule::class,
    'alnum' => AlfaNumericalRule::class,
    'between' => BetweenRule::class,
    'email' => EmailRule::class,
    'confirmed' => ConfirmedRule::class,
];