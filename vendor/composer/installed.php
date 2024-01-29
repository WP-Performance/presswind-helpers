<?php

return [
    'root' => [
        'name' => 'wp-performance/press-wind',
        'pretty_version' => 'dev-main',
        'version' => 'dev-main',
        'reference' => 'f8520466add0521c0a7af04ddc87fd6d87808662',
        'type' => 'library',
        'install_path' => __DIR__ . '/../../',
        'aliases' => [],
        'dev' => true,
    ],
    'versions' => [
        'wp-performance/press-wind' => [
            'pretty_version' => 'dev-main',
            'version' => 'dev-main',
            'reference' => 'f8520466add0521c0a7af04ddc87fd6d87808662',
            'type' => 'library',
            'install_path' => __DIR__ . '/../../',
            'aliases' => [],
            'dev_requirement' => false,
        ],
        'wp-performance/presswind-assets' => [
            'pretty_version' => 'dev-main',
            'version' => 'dev-main',
            'reference' => '2f03b580a17b90cff03ad306d92f755559af28b9',
            'type' => 'library',
            'install_path' => __DIR__ . '/../wp-performance/presswind-assets',
            'aliases' => [
                0 => '9999999-dev',
            ],
            'dev_requirement' => false,
        ],
    ],
];
