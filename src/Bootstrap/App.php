<?php
namespace Afkar\Test\Bootstrap;
use Afkar\Test\Support\Arr;
use Afkar\Test\Support\Config;
use Afkar\Test\Exception\Whoops;
use DirectoryIterator;
use Afkar\Test\Validation\Validator;

class App
{
    /**
     * App __construct
     */
    private function __construct(){}

    public static function loadConfig()
    {
        $files = array_diff(scandir(config_path()), ['.', '..']);
        foreach ($files as $file) {
            $files_name = explode('.', $file)[0];
            yield $files_name => require config_path() . DIRECTORY_SEPARATOR . $file;
        }
        // dump($files);
    }
    public static function loadProvider()
    {
        $files = array_diff(scandir(provider_path()), ['.', '..']);
        // dump($files);die();
        foreach ($files as $file) {
            $files_name = explode('.', $file)[0];
            yield $files_name => require provider_path() . DIRECTORY_SEPARATOR . $file;
        }
    }

    

    /**
     * Run App
     * 
     * @return void
     */
    public static function run()
    {
        //Register whoops
        Whoops::handle();

        //loadConfig
        // Config::setItems(static::loadConfig());
        // dump(Config::getItems());

        Config::setItems(static::loadProvider());
        // dump(provider("validation_provider"));

        // Validator::setRuleMap(provider("validation_provider"));

    }
}