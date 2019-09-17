<?php
/**
 * @package PusheWebpush
 */

namespace Inc;

final class Init
{
    /**
     * Store all classes inside an array
     *
     * @return array full list of classes
     */
    public static function get_services()
    {
        return array(
            base\Translation::class,
            pages\AdminPages::class,
            base\Enqueue::class,
            base\SettingsLinks::class,
            base\WebpushScripts::class,
        );
    }

    /**
     * Loop through the classes, initialize them,
     * and call the register() method if it exists
     */
    public static function register_services()
    {
        foreach (self::get_services() as $class) {
            $service = self::instantiate($class);
            if (method_exists($service, 'register')) {
                $service->register();
            }
        }
    }

    /**
     * Initialize the class
     *
     * @param $class  class from the services array
     * @return class instance  new instance of the class
     */
    private static function instantiate($class)
    {
        return new $class();
    }
}
