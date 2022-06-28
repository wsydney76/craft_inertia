<?php

use craft\helpers\UrlHelper;

return [
    'siteNav' => [
        ['label' => 'Posts', 'url' => '/posts'],
        ['label' => 'Topics', 'url' => '/topics'],
        ['label' => 'Contact', 'url' => '/contact'],
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
