<?php
use Afkar\Test\Bootstrap\App;


/*
|-------------------------------------------------
| helper function file
|-------------------------------------------------
|
| Helper Function For the application .
*/

require_once realpath(dirname(__DIR__ ). '/src/Support/helper.php');

class Application
{
    /**
     * Application Constructor
     */
    private function __construct() {}

    public static function run()
    {
        /**
         * Define root path
         */
        define('ROOT', realpath(__DIR__ . '/..'));

        /**
         * Define Directory Separator
         */
        define('DS', DIRECTORY_SEPARATOR);

        /**
         * Run The App
         */
        App::run();
    }
}