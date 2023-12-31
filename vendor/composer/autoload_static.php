<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit76f39019aa1b9c3fb94d4e07d4671ff1
{
    public static $files = array (
        '71ecd0286a4e74fd8732297fb587023c' => __DIR__ . '/..' . '/thingengineer/mysqli-database-class/MysqliDb.php',
        'd383f1ec7b1e54a09cb53eb6fcf751e0' => __DIR__ . '/..' . '/thingengineer/mysqli-database-class/dbObject.php',
    );

    public static $classMap = array (
        'AltoRouter' => __DIR__ . '/..' . '/altorouter/altorouter/AltoRouter.php',
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->classMap = ComposerStaticInit76f39019aa1b9c3fb94d4e07d4671ff1::$classMap;

        }, null, ClassLoader::class);
    }
}
