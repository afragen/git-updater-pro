<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit388fe1ef227f29d2ec552eefda83d5a9
{
    public static $files = array (
        '53e3f9b6a8f64a65f57c7ed51e0e37dc' => __DIR__ . '/..' . '/freemius/wordpress-sdk/start.php',
    );

    public static $prefixLengthsPsr4 = array (
        'F' => 
        array (
            'Fragen\\Git_Updater\\PRO\\' => 23,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Fragen\\Git_Updater\\PRO\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src/Git_Updater_PRO',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'Fragen\\Singleton' => __DIR__ . '/..' . '/afragen/singleton/Singleton.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit388fe1ef227f29d2ec552eefda83d5a9::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit388fe1ef227f29d2ec552eefda83d5a9::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit388fe1ef227f29d2ec552eefda83d5a9::$classMap;

        }, null, ClassLoader::class);
    }
}
