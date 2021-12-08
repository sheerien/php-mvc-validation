<?php 

use Afkar\Test\Support\Config;

if(! function_exists('env')){
    /**
     * set key for env
     * @param mixed $key
     * @param mixed $default
     * @return mixed
     */
    function env($key, $default = null){

        return $_ENV[$key] ?? value($default);

    }

}

if(! function_exists('value')){
    /**
     * set value from action routers
     * @param mixed $value
     * @return mixed
     */
    function value($value){

        return ($value instanceof Closure) ? $value() : $value;
        
    }
}

if (!function_exists('base_path')) {

    /**
     * base path for root
     * @return string
     */
    function base_path($path = ''){
        if(!empty($path)){
            return realpath( dirname(__DIR__). '/../' . $path);
        }
        return realpath( dirname(__DIR__) . '/../');
    }
}

if(!function_exists('config_path')){
    function config_path(){
        return realpath(dirname(__DIR__) . '/../config');
    }
}

if(!function_exists('config')){
    function config($key = null, $default = null){
        if(is_null($key)){
            return Config::getItems();
        }
        if(is_array($key)){
            return Config::set($key);
        }
        return Config::get($key, $default);
    }
}

if(!function_exists('provider')){
    function provider($key = null, $default = null){
        if(is_null($key)){
            return Config::getItems();
        }
        if(is_array($key)){
            return Config::set($key);
        }
        return Config::get($key, $default);
    }
}

if(!function_exists('provider_path')){
    function provider_path(){
        return realpath(dirname(__DIR__) . '/Providers');
    }
}
// if (!function_exists('assets')) {
//     /**
//      * assets
//      * 
//      * @return string
//      */
//     function assets($path = ''){
//         $path_value = $_SERVER['REQUEST_SCHEME'] . '://'.host_path();
//         if(!empty($path)){
//             foreach(explode('/',$path) as $p){
//                 $path_value .= rtrim(DIRECTORY_SEPARATOR. $p . DIRECTORY_SEPARATOR, DIRECTORY_SEPARATOR);
//             }
//             return $path_value;
//         }
//         throw new \InvalidArgumentException('not path ' .$path . 'exists');
        
//     }
// }