<?php

return [
    'root' => [
        'name' => 'wp-performance/press-wind',
        'pretty_version' => 'dev-main',
        'version' => 'dev-main',
        'reference' => '4c00ab2c34a688b02957e754f4d7eecbacacb779',
        'type' => 'library',
        'install_path' => __DIR__.'/../../',
        'aliases' => [],
        'dev' => true,
    ],
    'versions' => [
        'wp-performance/press-wind' => [
            'pretty_version' => 'dev-main',
            'version' => 'dev-main',
            'reference' => '4c00ab2c34a688b02957e754f4d7eecbacacb779',
            'type' => 'library',
            'install_path' => __DIR__.'/../../',
            'aliases' => [],
            'dev_requirement' => false,
        ],
        'wp-performance/presswind-assets' => [
            'pretty_version' => 'dev-main',
            'version' => 'dev-main',
            'reference' => '318b75d56e810c5d6387bb1138bfe836b1b09c2c',
            'type' => 'library',
            'install_path' => __DIR__.'/../wp-performance/presswind-assets',
            'aliases' => [
                0 => '9999999-dev',
            ],
            'dev_requirement' => false,
        ],
    ],
];
