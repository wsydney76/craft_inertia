<?php

use config\Env;
use wsydney76\inertia\web\Request;


return [
    'components' => [

        'request' => [
                'class' => Request::class,
            'cookieValidationKey' => Env::SECURITY_KEY
        ]

    ],
];
