<?php

use PressWind\Helpers\PWConfig;

test('get config disable rss', function () {
    PWConfig::$global_path = '/tests/dist';
    $rss = PWConfig::get('disable.rss');
    expect($rss)->toBeFalse();
});

test('get config app name', function () {
    PWConfig::$global_path = '/tests/dist';
    $name = PWConfig::get('manifest.appName');
    expect($name)->toBe('PressWind');
});

test('get config icon dir', function () {
    PWConfig::$global_path = '/tests/dist';
    $icon = PWConfig::get('iconsDir');
    expect($icon)->toBe('public');
});

test('get all config', function () {
    PWConfig::$global_path = '/tests/dist';
    $all = PWConfig::getAll();
    expect($all)->toBeArray();
    expect($all['disable']['rss'])->toBeFalse();
});
