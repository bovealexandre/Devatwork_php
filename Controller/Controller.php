<?php
abstract class Controller
{
    private static $instances = array();

    private function __construct()
    {

    }

    public static function getInstance()
    {
        $class = get_called_class();

        if (!isset($instances[$class])) {
            self::$instances[$class] = new $class();
        }

        return self::$instances[$class];
    }

    private function __clone()
    {
    }

    private function __sleep()
    {
    }

    private function __wakeup()
    {
    }
}