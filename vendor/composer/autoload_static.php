<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit87a7dbd79a8f2c3a5e2fd4e8c86c0a76
{
    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'avashoo\\Actions' => __DIR__ . '/../..' . '/includes/actions.php',
        'avashoo\\Enqueuecss' => __DIR__ . '/../..' . '/includes/enqueue.php',
        'avashoo\\GetMp3Url' => __DIR__ . '/../..' . '/services/getUrl.php',
        'avashoo\\GrapToPost' => __DIR__ . '/../..' . '/includes/embedToPost.php',
        'avashoo\\Meta_Boxes' => __DIR__ . '/../..' . '/includes/add-metabox.php',
        'avashoo\\Postandupdate' => __DIR__ . '/../..' . '/services/post.php',
        'avashoo\\avashoSettingsPage' => __DIR__ . '/../..' . '/includes/settingField.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->classMap = ComposerStaticInit87a7dbd79a8f2c3a5e2fd4e8c86c0a76::$classMap;

        }, null, ClassLoader::class);
    }
}
