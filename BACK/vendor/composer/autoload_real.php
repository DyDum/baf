<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInit449a57b11571bcb40894d57f8725215d
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        spl_autoload_register(array('ComposerAutoloaderInit449a57b11571bcb40894d57f8725215d', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInit449a57b11571bcb40894d57f8725215d', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInit449a57b11571bcb40894d57f8725215d::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
