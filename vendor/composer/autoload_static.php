<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

use Closure;

class ComposerStaticInit0e895c4cce9db96b0019f33db4b64344
{
    public static $prefixLengthsPsr4 = [
        'P' => [
            'PressWind\\' => 10,
        ],
    ];

    public static $prefixDirsPsr4 = [
        'PressWind\\' => [
            0 => __DIR__.'/../..'.'/src',
            1 => __DIR__.'/..'.'/wp-performance/presswind-assets/src',
        ],
    ];

    public static $classMap = [
        'Composer\\InstalledVersions' => __DIR__.'/..'.'/composer/InstalledVersions.php',
    ];

    public static function getInitializer(ClassLoader $loader)
    {
        return Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit0e895c4cce9db96b0019f33db4b64344::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit0e895c4cce9db96b0019f33db4b64344::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit0e895c4cce9db96b0019f33db4b64344::$classMap;

        }, null, ClassLoader::class);
    }
}
