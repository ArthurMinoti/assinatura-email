<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInitfaaf6b56ef0d29cc2cb41fe591305b37
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

        spl_autoload_register(array('ComposerAutoloaderInitfaaf6b56ef0d29cc2cb41fe591305b37', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInitfaaf6b56ef0d29cc2cb41fe591305b37', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInitfaaf6b56ef0d29cc2cb41fe591305b37::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}