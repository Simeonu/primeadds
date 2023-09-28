<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit023386c1a4185c8e0a0c63e60d75ae1b
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit023386c1a4185c8e0a0c63e60d75ae1b::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit023386c1a4185c8e0a0c63e60d75ae1b::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit023386c1a4185c8e0a0c63e60d75ae1b::$classMap;

        }, null, ClassLoader::class);
    }
}