<?php

return [
    'root' => [
        'name' => 'wp-performance/press-wind',
        'pretty_version' => 'dev-main',
        'version' => 'dev-main',
        'reference' => 'cd9dc37a5102511c57ed717298d031573d95961e',
        'type' => 'library',
        'install_path' => __DIR__.'/../../',
        'aliases' => [],
        'dev' => true,
    ],
    'versions' => [
        'wp-performance/press-wind' => [
            'pretty_version' => 'dev-main',
            'version' => 'dev-main',
            'reference' => 'cd9dc37a5102511c57ed717298d031573d95961e',
            'type' => 'library',
            'install_path' => __DIR__.'/../../',
            'aliases' => [],
            'dev_requirement' => false,
        ],
        'wp-performance/presswind-assets' => [
            'pretty_version' => 'dev-main',
            'version' => 'dev-main',
            'reference' => '5bbd5e224d1573f8342904c910cbcc1a964d4bbc',
            'type' => 'library',
            'install_path' => __DIR__.'/../wp-performance/presswind-assets',
            'aliases' => [
                0 => '9999999-dev',
            ],
            'dev_requirement' => false,
        ],
    ],
];
