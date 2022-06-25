<?php
/**
 * General Configuration
 *
 * All of your system's general configuration settings go in here. You can see a
 * list of the available settings in vendor/craftcms/cms/src/config/GeneralConfig.php.
 *
 * @see \craft\config\GeneralConfig
 */

use config\Env;

// Set Variables for use in CP
Env::setCpVars();

return [
    // Global settings
    '*' => [

        // 'headlessMode' => true,

        // Default Week Start Day (0 = Sunday, 1 = Monday...)
        'defaultWeekStartDay' => 1,

        // Whether generated URLs should omit "index.php"
        'omitScriptNameInUrls' => true,

        // Control Panel trigger word
        'cpTrigger' => 'admin',

        // The string preceding a number which Craft will look for when determining if the current request is for a particular page in a paginated list of pages.
        // 'pageTrigger' => 'page/',

        // Whether to send the 'Powered by Craft' http header
        'sendPoweredByHeader' => false,

        // Whether a Content-Length header should be sent with responses.
        'sendContentLengthHeader' => true,

        // Whether Craft should create a database backup before applying a new system update
        'backupOnUpdate' => true,

        // Whether to enable Craft's template {% cache %} tag on a global basis
        'enableTemplateCaching' => false,

        // Whether to enable GraphQL
        'enableGql' => true,

        // Whether to enable caching of GraphQL queries
        'enableGraphqlCaching' => false,

        // Max No. of revisions
        'maxRevisions' => 10,

        // Whether uploaded filenames with non-ASCII characters should be converted to ASCII
        'convertFilenamesToAscii' => true,

        //Whether non-ASCII characters in auto-generated slugs should be converted to ASCII
        'limitAutoSlugsToAscii' => true,

        // Whether images transforms should be generated before page load.
        'generateTransformsBeforePageLoad' => true,

        // Whether asset URLs should be revved so browsers don’t load cached versions when they’re modified.
        'revAssetUrls' => true,

        //The prefix that should be prepended to HTTP error status codes when determining the path to look for an error’s template.
        'errorTemplatePrefix' => '_errors/',

        'aliases' => [

            // Prevent the @web alias from being set automatically (cache poisoning vulnerability)
            '@web' => Env::BASE_URL,

            // Base Url
            '@baseurl' => Env::BASE_URL,

            // Lets `./craft clear-caches all` clear CP resources cache
            '@webroot' => dirname(__DIR__) . '/web',

        ],

        // The secure key Craft will use for hashing and encrypting data
        'securityKey' => Env::SECURITY_KEY,

        // Whether front end requests should respond with X-Robots-Tag: none HTTP headers
        'disallowRobots' => true,

        // Allow Open Document file types for upload
        'extraFileKinds' => [
            'opendocument' => [
                'label' => 'Open Document',
                'extensions' => ['odt', 'ods', 'odp', 'odg'],
            ],
        ],

        // use JavaScript lib to preserve scroll positions in preview
        'useIframeResizer' => true,
    ],

    // Temporary Settings for installing or upgrading the site
    'install' => [
        'isSystemLive' => false,
    ],

    'safe' => [
        'devMode' => true,
        'disabledPlugins' => '*'
    ],

    // Dev environment settings
    'dev' => [
        // Dev Mode (see https://craftcms.com/guides/what-dev-mode-does)
        'devMode' => true
    ],

    // Staging environment settings
    'staging' => [
        // Set this to `false` to prevent administrative changes from being made on staging
        'allowAdminChanges' => false
    ],

    // Production environment settings
    'production' => [
        // Set this to `false` to prevent administrative changes from being made on production
        'allowAdminChanges' => false,

        // Whether to enable Craft's template {% cache %} tag on a global basis
        'enableTemplateCaching' => true,

        // Whether to enable caching of GraphQL queries
        'enableGraphqlCaching' => true,

        // Whether front end requests should respond with X-Robots-Tag: none HTTP headers
        'disallowRobots' => false
    ],
];
