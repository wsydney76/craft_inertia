<?php

use craft\helpers\UrlHelper;

return [
    'frontendView' => 'frontend/inertia.twig',
    'siteNav' => [
        ['label' => 'Posts', 'url' => '/posts'],
        ['label' => 'Topics', 'url' => '/topics'],
        ['label' => 'Contact', 'url' => '/contact'],
    ],
    'assetDirs' => [
        '@webroot/assets/inertia'
    ],
    'contactConfirmationContinueButtons' => [
        [
            'label' => 'Write another message',
            'url' => UrlHelper::siteUrl('/contact')
        ],
        [
            'label' => 'Goto dashboard',
            'url' => UrlHelper::siteUrl('/')
        ]
    ],
    'contactConfirmationMessage' => 'Thank you for your message. Unfortunately this is only a demo, so nothing will happen.'
];
