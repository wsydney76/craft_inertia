<?php

return [
    'fields' => [
        'bodyContent' => [
            'groups' => [
                 [
                    'label' => 'Media',
                    'types' => ['image', 'gallery','embed'],
                ], [
                    'label' => 'Special',
                    'types' => ['button', 'quote', 'features']
                ]
            ],
            'types' => [
                'text' => [
                    'tabs' => [
                        [
                            'label' => 'Content',
                            'fields' => ['text'],
                        ], [
                            'label' => 'Layout',
                            'fields' => ['display'],
                        ]
                    ]
                ],
                'quote' => [
                    'tabs' => [
                        [
                            'label' => 'Content',
                            'fields' => ['text', 'attribution'],
                        ], [
                            'label' => 'Layout',
                            'fields' => ['display'],
                        ]
                    ]
                ],
                'image' => [
                    'tabs' => [
                        [
                            'label' => 'Content',
                            'fields' => ['image', 'caption'],
                        ], [
                            'label' => 'Layout',
                            'fields' => ['display'],
                        ]
                    ]
                ],
                'button' => [
                    'tabs' => [
                        [
                            'label' => 'Content',
                            'fields' => ['target', 'caption'],
                        ], [
                            'label' => 'Layout',
                            'fields' => ['color', 'display'],
                        ]
                    ]
                ],
            ],
        ]
    ],
];
