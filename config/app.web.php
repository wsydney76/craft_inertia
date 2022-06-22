<?php

use config\Env;
use modules\inertia\web\Request;
use craft\web\Response as WebResponse;

return [
    'components' => [

        'response' => function() {
            $config = [
                'class' => WebResponse::class,
            ];
            return Craft::createObject($config);
        },
        'request' => [
            'class' => Request::class,
            'cookieValidationKey' => Env::SECURITY_KEY
        ]

    ],
];
