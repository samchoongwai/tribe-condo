<?php

    $url_prefix = '/tribe';
    /* Custom environment configuration */
    /* 20210513 by Sam */
    return [
        'url_prefix' => '/tribe',
        'menu' => [
            'ADM' => [
                [
                    'title' => 'Dashboard',
                    'link' => $url_prefix . DS . 'dashboard',
                    'class' => 'dashboard',
                    'icon_class' => 'fas fa-tachometer-alt',
                    'access' => [
                        'ADM'
                    ]
                ],
                [
                    'title' => 'Visitor Logs',
                    'link' => $url_prefix . DS . 'visitor-logs',
                    'class' => 'visitor-logs',
                    'icon_class' => 'fas fa-clipboard-list',
                    'access' => [
                        'ADM'
                    ]
                ],
                [
                    'title' => 'Visitors',
                    'link' => $url_prefix . DS . 'visitor-logs/visitor-list',
                    'class' => 'visitors',
                    'icon_class' => 'fas fa-id-card',
                    'access' => [
                        'ADM'
                    ]
                ],
                [
                    'title' => 'Units Management',
                    'link' => $url_prefix . DS . 'units',
                    'class' => 'units',
                    'icon_class' => 'fas fa-home',
                    'access' => [
                        'ADM'
                    ]
                ],
                [
                    'title' => 'User Management',
                    'link' => $url_prefix . DS . 'users',
                    'class' => 'users',
                    'icon_class' => 'fas fa-users',
                    'access' => [
                        'ADM'
                    ]
                ],
                [
                    'title' => 'Unit Types',
                    'link' => $url_prefix . DS . 'unit-types',
                    'class' => 'unit-types',
                    'icon_class' => 'fas fa-cog',
                    'access' => [
                        'ADM'
                    ]
                ]
            ],
            'REP' => [
                [
                    'title' => 'Visitor Logs',
                    'link' => $url_prefix . DS . 'visitor-logs/registration',
                    'class' => 'visitor-logs',
                    'icon_class' => 'fas fa-clipboard-list',
                    'access' => [
                        'ADM'
                    ]
                ]
            ]
        ]
    ];
