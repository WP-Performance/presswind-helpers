<?php

use PressWind\PWAsset;

test('is not css file', function () {
    $is_css = get_method(PWAsset::class, 'is_css');
    $css = $is_css->invokeArgs(new PWAsset(), ['style.js']);
    expect($css)->toBeFalse();
});

test('is not css file too', function () {
    $is_css = get_method(PWAsset::class, 'is_css');
    $css = $is_css->invokeArgs(new PWAsset(), ['style.css.js']);
    expect($css)->toBeFalse();
});

test('is css file', function () {
    $is_css = get_method(PWAsset::class, 'is_css');
    $css = $is_css->invokeArgs(new PWAsset(), ['style.css']);
    expect($css)->toBeTrue();
});

test('is css file too', function () {
    $is_css = get_method(PWAsset::class, 'is_css');
    $css = $is_css->invokeArgs(new PWAsset(), ['test-style.css']);
    expect($css)->toBeTrue();
});
