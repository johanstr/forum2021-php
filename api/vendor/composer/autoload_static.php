<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit83cbfae2f8c29e99ef358c4f96bd287e
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit83cbfae2f8c29e99ef358c4f96bd287e::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit83cbfae2f8c29e99ef358c4f96bd287e::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit83cbfae2f8c29e99ef358c4f96bd287e::$classMap;

        }, null, ClassLoader::class);
    }
}
