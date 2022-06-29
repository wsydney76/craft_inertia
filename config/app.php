<?php
/**
 * Yii Application Config
 *
 * Edit this file at your own risk!
 *
 * The array returned by this file will get merged with
 * vendor/craftcms/cms/src/config/app.php and app.[web|console].php, when
 * Craft's bootstrap script is defining the configuration for the entire
 * application.
 *
 * You can define custom modules and system components, and even override the
 * built-in system components.
 *
 * If you want to modify the application config for *only* web requests or
 * *only* console requests, create an app.web.php or app.console.php file in
 * your config/ folder, alongside this one.
 */

use config\Env;
use modules\frontend\AppModule;
use modules\main\MainModule;

return [
    'id' => Env::APP_ID,
    'modules' => [
        'main' => MainModule::class,
        'frontend' => AppModule::class
    ],
    'bootstrap' => [
        'main',
        'frontend'
    ]
    /*'components' => [
        'cache' => [
            'class' => yii\caching\MemCache::class,
            'useMemcached' => false,
            'defaultDuration' => 86400,
            'servers' => [
                [
                    'host' => 'localhost',
                    'persistent' => true,
                    'port' => 11211,
                    'retryInterval' => 15,
                    'status' => true,
                    'timeout' => 15,
                    'weight' => 1,
                ],
            ],
            'keyPrefix' => Env::APP_ID ?: 'CraftCMS_fsff',
        ],
    ],*/
];
