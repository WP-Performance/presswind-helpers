<?php

use PressWind\PWManifest;

function get_file_method(): ReflectionMethod
{
    return get_method(PWManifest::class, 'get_file');
}

test('get manifest', function () {
    $manifest = PWManifest::getOrdered('tests/');
    expect($manifest['8331d2aa']->file)->toBe('assets/main-8331d2aa.js');
});

test('get token name', function () {

    $manifest = PWManifest::getOrdered('tests/');

    $get_token_name = get_method(PWManifest::class, 'get_token_name');

    $token = $get_token_name->invokeArgs(
        new PWManifest(),
        [$manifest['8331d2aa']->file]
    );
    expect($token)->toBe('8331d2aa');

    $token = $get_token_name->invokeArgs(
        new PWManifest(),
        [$manifest['6fc5fb3f']->file]
    );

    expect($token)->toBe('6fc5fb3f');
});

test('keep only entries', function () {

    $keep_entries = get_method(PWManifest::class, 'keep_entries');
    $get_file = get_file_method();

    $manifest = $get_file->invokeArgs(
        new PWManifest(),
        ['tests/']
    );

    $cleaned = $keep_entries->invokeArgs(
        new PWManifest(),
        [$manifest]
    );

    foreach ($cleaned as $key => $value) {
        if (strpos($value->file, '.css') > 0) {
            continue;
        }
        expect($value->isEntry)->toBeTrue();
    }
});

test('get legacy and polyfill', function () {

    $move_legacy_and_polyfill = get_method(PWManifest::class, 'move_legacy_and_polyfill');
    $get_file = get_file_method();

    $results = $move_legacy_and_polyfill->invokeArgs(
        new PWManifest(),
        [$get_file->invokeArgs(
            new PWManifest(),
            ['tests/']
        )]
    );

    expect(strpos($results['polyfill']->src, 'polyfills'))->not->toBeFalse();
    expect(strpos($results['polyfill']->src, 'legacy'))->not->toBeFalse();
    expect(strpos($results['legacy']->src, 'polyfills'))->toBeFalse();
    expect(strpos($results['legacy']->src, 'legacy'))->not->toBeFalse();
});

test('order manifest', function () {

    $order_manifest = get_method(PWManifest::class, 'order_manifest');
    $get_file = get_file_method();

    $manifest = $get_file->invokeArgs(
        new PWManifest(),
        ['tests/']
    );

    $results = $order_manifest->invokeArgs(
        new PWManifest(),
        [$manifest]
    );

    foreach ($results as $key => $value) {
        if (strpos($value->file, '.css') > 0) {
            continue;
        }
        expect($value->isEntry)->toBeTrue();
    }

    $k = array_keys($results);

    expect(strpos($results[$k[count($k) - 2]]->src, 'polyfills'))->not->toBeFalse();
    expect(strpos($results[$k[count($k) - 2]]->src, 'legacy'))->not->toBeFalse();
    expect(strpos($results[$k[count($k) - 1]]->src, 'polyfills'))->toBeFalse();
    expect(strpos($results[$k[count($k) - 1]]->src, 'legacy'))->not->toBeFalse();
});
