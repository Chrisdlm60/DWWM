<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitd2464456a90b520c94d5aa16b0edcf0f
{
    public static $prefixLengthsPsr4 = array (
        'O' => 
        array (
            'OnBoarding\\' => 11,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'OnBoarding\\' => 
        array (
            0 => __DIR__ . '/../..' . '/OnBoarding',
        ),
    );

    public static $classMap = array (
        'OnBoarding\\Configuration' => __DIR__ . '/../..' . '/OnBoarding/Configuration.php',
        'OnBoarding\\OnBoarding' => __DIR__ . '/../..' . '/OnBoarding/OnBoarding.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitd2464456a90b520c94d5aa16b0edcf0f::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitd2464456a90b520c94d5aa16b0edcf0f::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitd2464456a90b520c94d5aa16b0edcf0f::$classMap;

        }, null, ClassLoader::class);
    }
}
