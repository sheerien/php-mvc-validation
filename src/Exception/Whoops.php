<?php
namespace Afkar\Test\Exception;


class Whoops
{
    /**
     * Whoops __construct
     */
    private function __construct(){}

    /**
     * error handle
     * @return void
     */
    public static function handle()
    {
        $whoops = new \Whoops\Run;
        $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
        $whoops->register();
    }
}