<?php 
namespace Afkar\Test\Validation\core;

class Message
{
    public static function generate($rule, $field)
    {
        return str_replace('%s', $field, $rule);
    }
}