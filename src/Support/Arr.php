<?php
namespace Afkar\Test\Support;

class Arr
{
    /**
     * Arr Constructor
     */
    private function __construct() {}

        /**
     * Get the Arr object, so it can be used as a dependency of getArr
     * 
     * @return Arr
     */
    public static function getArr()
    {
        return new self;
    }
    /**
     * Get only value from an array of key.
     * 
     * @param array $array
     * @param mixed $keys
     * @return array
     */
    public static function only(array $array, $keys)
    {
        return array_intersect_key($array, array_flip((array)$keys));
    }

    /**
     * array is accessible
     * 
     * @param mixed $value
     * @return bool
     */
    public static function accessible($value)
    {
        return is_array($value) || $value instanceof \ArrayAccess;
    }

    /**
     * Check key if exists in this array or not
     * 
     * @param array $array
     * @param mixed $key
     * @return bool
     */
    public static function exists(array $array, $key)
    {
        if($array instanceof \ArrayAccess){
            return $array->offsetExists($key);
        }
        
        return array_key_exists($key, $array);
    }

    /**
     * Check this array has  key in or not it
     * 
     * @param array $array
     * @param mixed $keys
     * @return bool
     */
    public static function has(array $array, $keys)
    {
        if(is_null($keys)){
            return false;
        }
        
        $keys = (array)$keys;
        
        if(empty($keys) && $keys === []){
            return false;
        }
        
        foreach ($keys as $key) {
            $subArray = $array;
            if(static::exists($array, $key)){
                continue;
            }
            
            foreach (explode('.', $key) as $segment) {
                if(static::accessible($subArray) && static::exists($subArray, $segment)){
                    $subArray = $subArray[$segment];
                }else{
                    return false;
                }
            }
        }
        
        return true;
    }

    // go to file of helper function
    /**
     *  check value of param,if instanceof closure, invoke it, if not it, return as it is.
     * 
     * @param mixed $value
     * @return mixed
     */
    public static function value($value)
    {
        return ($value instanceof \Closure) ? $value() : $value;
    }

    /**
     * Get last item from an array.
     * g
     * @param array $array
     * @param callable|null $callback
     * @param mixed $default
     * @return mixed
     */
    public static function last(array $array, callable $callback = null, $default = null)
    {
        if(is_null($callback)){
            return empty($array) ? static::value($default) : end($array);
        }
        
        return static::first(array_reverse($array, true), $callback, $default);
    }

    /**
     * Get first item from an array.
     * 
     * @param array $array
     * @param callable|null $callback
     * @param mixed $default
     * @return mixed
     */
    public static function first(array $array, callable $callback = null, $default = null)
    {
        if(is_null($callback)){
            
            if(empty($array)){
                return static::value($default);
            }
            
            foreach ($array as $item) {
                return $item;
            }
        }
        
        foreach ($array as $key => $value) {
            if(call_user_func($callback,$value, $key)){
                return $value;
            }
        }
        
        return static::value($default);
    }

    /**
     * forget value key from an array
     * 
     * @param array $array
     * @param mixed $keys
     * @return mixed
     */
    public static function forget(array &$array, $keys)
    {
        $original = & $array;
        $keys = (array)$keys;
        
        if(!count($keys)){
            return [];
        }
        
        foreach ($keys as $key) {
            if(static::exists($array, $key)){
                unset($array[$key]);
                
                continue;
            }
            
            $parts = explode('.', $key);
            while (count($parts) > 1){
                $part = array_shift($parts);
                
                if(isset($array[$part]) && is_array($array[$part])){
                    $array = &$array[$part];
                }else{
                    continue;
                }
                
            }
            
            unset($array[array_shift($parts)]);
        }
        
    }

    /**
     * prevent fetch value of this key .
     * 
     * @param array $array
     * @param mixed $keys
     * @return mixed
     */
    public static function except(array $array, $keys)
    {
        return static::forget($array, $keys);
    }

    public static function flatten(array $array, $depth = INF)
    {
        $result = [];

        foreach ($array as $item) {
            if(!is_array($item)){
                $result[] = $item;
            }elseif($depth === 1){
                $result = array_merge($result, array_values($item));
            }else{
                $result = array_merge($result, static::flatten($item, $depth - 1));
            }
        }
        return $result;
    }

    /**
     * Get value from an array of key.
     * 
     * @param array $array
     * @param mixed $key
     * @param mixed $default
     * @return mixed
     */
    public static function get(array $array, $key, $default = null)
    {
        if(!static::accessible($array)){
            return static::value($default);
        }
        
        if(is_null($key)){
            return $array;
        }
        
        if(static::exists($array, $key)){
            return $array[$key];
        }
        
        if(!str_contains($key, '.')){
            return $array[$key]??static::value($default);
        }
        
        foreach (explode('.', $key)as $segment) {
            if(static::accessible($array) && static::exists($array, $segment)){
                $array = $array[$segment];
            }else{
                return static::value($default);
            }
        }
        
        return $array;
    }

    /**
     * Set value to an array of key.
     * 
     * @param array $array
     * @param mixed $key
     * @param mixed $value
     * @return mixed
     */
    public static function set(array &$array, $key, $value)
    {
        if(is_null($key)){
            return array_push($array, $value);
        }
        
        $keys = explode('.', $key);
        
        while(count($keys) >1){
            $key = array_shift($keys);
            $array = &$array[$key];
        }
        
        $array[array_shift($keys)] = $value;
        
        return $array;
    }

    /**
     * Unset value from an array of key.
     * 
     * @param array $array
     * @param mixed $key
     * @return void
     */
    public static function unset(array $array, $key)
    {
        static::set($array, $key, null);
    }
}