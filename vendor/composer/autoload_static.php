<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit3735f90a5463da34874554866a2db92b
{
    public static $prefixLengthsPsr4 = array (
        'F' => 
        array (
            'Fragen\\Git_Updater\\PRO\\' => 23,
            'Fragen\\Git_Updater\\API\\' => 23,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Fragen\\Git_Updater\\PRO\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src/Git_Updater_PRO',
        ),
        'Fragen\\Git_Updater\\API\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src/Git_Updater_PRO/API',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'Fragen\\Singleton' => __DIR__ . '/..' . '/afragen/singleton/Singleton.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit3735f90a5463da34874554866a2db92b::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit3735f90a5463da34874554866a2db92b::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit3735f90a5463da34874554866a2db92b::$classMap;

        }, null, ClassLoader::class);
    }
}
