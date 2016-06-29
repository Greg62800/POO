<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit07fbd8837be55ea80adb3510aa2385a8
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'POO\\' => 4,
        ),
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'POO\\' => 
        array (
            0 => __DIR__ . '/../..' . '/POOFrameworks',
        ),
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit07fbd8837be55ea80adb3510aa2385a8::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit07fbd8837be55ea80adb3510aa2385a8::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}