<?php

return [
    'root' => [
        'name' => 'wp-performance/press-wind',
        'pretty_version' => 'dev-main',
        'version' => 'dev-main',
        'reference' => '65cad30432f5038a6f02789c006bf984957e97a9',
        'type' => 'library',
        'install_path' => __DIR__.'/../../',
        'aliases' => [],
        'dev' => true,
    ],
    'versions' => [
        'wp-performance/press-wind' => [
            'pretty_version' => 'dev-main',
            'version' => 'dev-main',
            'reference' => '65cad30432f5038a6f02789c006bf984957e97a9',
            'type' => 'library',
            'install_path' => __DIR__.'/../../',
            'aliases' => [],
            'dev_requirement' => false,
        ],
        'wp-performance/presswind-assets' => [
            'pretty_version' => 'dev-main',
            'version' => 'dev-main',
            'reference' => '2b322429b2b67546526cbef852e87b2aae86e3fe',
            'type' => 'library',
            'install_path' => __DIR__.'/../wp-performance/presswind-assets',
            'aliases' => [
                0 => '9999999-dev',
            ],
            'dev_requirement' => false,
        ],
    ],
];
