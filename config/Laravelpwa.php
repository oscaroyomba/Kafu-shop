<?php

return [

    'name' => 'SM Marketplace',
    'short_name' => 'SM',
    'start_url' => '/',
    'display' => 'standalone',
    'theme_color' => '#1976d2',
    'background_color' => '#ffffff',
    'orientation' => 'portrait',
    'status_bar' => 'black',

    'icons' => [
        '72x72' => [
            'path' => '/images/icons/icon-72x72.png',
            'purpose' => 'any',
        ],
        '96x96' => [
            'path' => '/images/icons/icon-96x96.png',
            'purpose' => 'any',
        ],
        '128x128' => [
            'path' => '/images/icons/icon-128x128.png',
            'purpose' => 'any',
        ],
    ],

    'offline_enabled' => true,
    'offline_page' => 'offline',

];