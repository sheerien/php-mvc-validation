<?php
namespace Afkar\Test\Validation\core;

trait RuleResolver
{
    public  static function make(array|string $rules)
    {
        if(is_string($rules)){
        
            $rules = str_contains($rules, '|') ? explode('|', $rules) : [$rules];

        }
        return array_map(function( $rule){
            if(is_string($rule)){
                return static::getRuleFromString($rule);
            }

            return $rule;
        },$rules);
    }

    public  static function getRuleFromString(string $rule)
    {
        [$rule, $options] = RuleMapHandler::handleReceivedRule($rule);
        
        return RuleMapHandler::resolve($rule, $options);
    }
}