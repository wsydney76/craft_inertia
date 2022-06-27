<?php

use config\Env;
use wsydney76\inertia\web\Request;
use wsydney76\inertia\web\Response as WebResponse;

return [
    'components' => [

        // Uncomment when running Craft in headless mode
        // Don't return HTML responses as JSON

        /* response' => function() {
             $config = [
                 'class' => WebResponse::class,
             ];
             return Craft::createObject($config);
         },*/

        'request' => [
            'class' => Request::class,
            'cookieValidationKey' => Env::SECURITY_KEY
        ]

    ],
];
