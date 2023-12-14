<?php

return [
    'root' => [
        'name' => 'wp-performance/press-wind',
        'pretty_version' => 'dev-main',
        'version' => 'dev-main',
        'reference' => '8f0115b289b839534e2c0dfd6464e057b2873450',
        'type' => 'library',
        'install_path' => __DIR__.'/../../',
        'aliases' => [],
        'dev' => true,
    ],
    'versions' => [
        'wp-performance/press-wind' => [
            'pretty_version' => 'dev-main',
            'version' => 'dev-main',
            'reference' => '8f0115b289b839534e2c0dfd6464e057b2873450',
            'type' => 'library',
            'install_path' => __DIR__.'/../../',
            'aliases' => [],
            'dev_requirement' => false,
        ],
        'wp-performance/presswind-assets' => [
            'pretty_version' => 'dev-main',
            'version' => 'dev-main',
            'reference' => '305a2f0700dc4f55f2e2c48cabdf036081748807',
            'type' => 'library',
            'install_path' => __DIR__.'/../wp-performance/presswind-assets',
            'aliases' => [
                0 => '9999999-dev',
            ],
            'dev_requirement' => false,
        ],
    ],
];
