<?php

use PressWind\Helpers\PWConfig;

PWConfig::$default_path = '/src/';
PWConfig::$global_path = '/tests/dist';

test('get config disable rss', function () {
    $rss = PWConfig::get('disable.rss');
    expect($rss)->toBeFalse();
});

test('get config app name', function () {
    $name = PWConfig::get('manifest.appName');
    expect($name)->toBe('PressWind');
});

test('get config icon dir', function () {
    $icon = PWConfig::get('iconsDir');
    expect($icon)->toBe('public');
});

test('get all config', function () {
    $all = PWConfig::getAll();
    expect($all)->toBeArray();
    expect($all['disable']['rss'])->toBeFalse();
});
