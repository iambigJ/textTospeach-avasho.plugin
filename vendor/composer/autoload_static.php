<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit87a7dbd79a8f2c3a5e2fd4e8c86c0a76
{
    public static $classMap = array (
        'Audio_Functionality_Plugin' => __DIR__ . '/../..' . '/includes/actions.php',
        'AvashoSettingsPage' => __DIR__ . '/../..' . '/includes/add_setting_field.php',
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'Getinfoavasho' => __DIR__ . '/../..' . '/services/get-url.php',
        'GrapToPost' => __DIR__ . '/../..' . '/includes/add-mp3-to-post.php',
        'Meta_Boxes' => __DIR__ . '/../..' . '/includes/add-metabox.php',
        'Postandupdate' => __DIR__ . '/../..' . '/services/post.php',
        'Saveandremove' => __DIR__ . '/../..' . '/includes/save-in-datebase.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->classMap = ComposerStaticInit87a7dbd79a8f2c3a5e2fd4e8c86c0a76::$classMap;

        }, null, ClassLoader::class);
    }
}
