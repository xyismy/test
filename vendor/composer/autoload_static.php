<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit89df91d6c96281c0efadecc7ccb0b3d6
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PhpAmqpLib\\' => 11,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PhpAmqpLib\\' => 
        array (
            0 => __DIR__ . '/..' . '/php-amqplib/php-amqplib/PhpAmqpLib',
        ),
    );

    public static $prefixesPsr0 = array (
        'M' => 
        array (
            'Monolog' => 
            array (
                0 => __DIR__ . '/..' . '/monolog/monolog/src',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit89df91d6c96281c0efadecc7ccb0b3d6::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit89df91d6c96281c0efadecc7ccb0b3d6::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInit89df91d6c96281c0efadecc7ccb0b3d6::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}
