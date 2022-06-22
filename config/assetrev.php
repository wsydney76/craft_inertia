<?php

/**
 * Asset Rev plugin config
 *
 * For hot module reloading with the Webpack Dev Server, this expects a few values
 * to be set in the `.env` file:
 *
 * ```
 * WEBPACK_SERVER_URL="http://localhost:8080"
 * USE_WEBPACK_DEV_SERVER=1 # set to 0 (zero) to turn off
 * ```
 *
 * The base asset url will be based on `WEBPACK_SERVER_URL` if:
 *
 * 1. The Craft environment is "dev" (`ENVIRONMENT` in `.env`)
 * 2. `USE_WEBPACK_DEV_SERVER` is set to `1`
 *
 * Otherwise it will be based on `DEFAULT_SITE_URL`
 *
 * @see https://github.com/clubstudioltd/craft-asset-rev
 */

use club\assetrev\utilities\strategies\ManifestFileStrategy;
use config\Env;
// use craft\helpers\App;

return [
    '*' => [
        'strategies' => [
            'manifest' => ManifestFileStrategy::class,
            'noManifest' => function() {
                return '';
            }
        ],
        'assetUrlPrefix' => Env::BASE_URL,// . '/assets/dist/',
        //'assetUrlPrefix' =>App::env('PRIMARY_SITE_URL')// . '/assets/dist/',
        'manifestPath' => 'web/assets/dist/manifest.json',
        'pipeline' => 'manifest|noManifest',
    ]
];
