<?php

test('is not dev', function () {
    $is_dev = \PressWind\PWApp::isDev();
    expect($is_dev)->toBeFalse();
});

test('is dev', function () {
    define('WP_ENV', 'development');
    $is_dev = \PressWind\PWApp::isDev();
    expect($is_dev)->toBeTrue();
});
