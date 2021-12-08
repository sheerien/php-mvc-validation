<?php
namespace Afkar\Test\Validation\core;

trait RuleMapHandler
{
    protected static array $map =[];

    private static function ruleMap()
    {
        return static::$map = provider("validation_provider");
    }

    public static function resolve($rule, $options )
    {
        static::$map = static::ruleMap();
        return new static::$map[$rule](...$options);
    }
    
    public static function handleReceivedRule(string $rule)
    {
        $ruleExploded = explode(':',$rule);
        $rule = $ruleExploded[0];
        $options = explode(',', end($ruleExploded));

        return [$rule, $options];
    }
}