<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit69148dc360432ee325098b47ff1dcc11
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
        'App\\Controller\\Pages\\Home' => __DIR__ . '/../..' . '/app/Controller/Pages/Home.php',
        'App\\Controller\\Pages\\Page' => __DIR__ . '/../..' . '/app/Controller/Pages/Page.php',
        'App\\Http\\Request' => __DIR__ . '/../..' . '/app/Http/Request.php',
        'App\\Http\\Response' => __DIR__ . '/../..' . '/app/Http/Response.php',
        'App\\Http\\Router' => __DIR__ . '/../..' . '/app/Http/Router.php',
        'App\\Model\\Entity\\Organization' => __DIR__ . '/../..' . '/app/Model/Entity/Organization.php',
        'App\\Utils\\View' => __DIR__ . '/../..' . '/app/Utils/View.php',
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit69148dc360432ee325098b47ff1dcc11::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit69148dc360432ee325098b47ff1dcc11::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit69148dc360432ee325098b47ff1dcc11::$classMap;

        }, null, ClassLoader::class);
    }
}
