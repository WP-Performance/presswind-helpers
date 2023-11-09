<?php

use PressWind\Helpers\PWManifest;

test('get manifest', function () {
    $manifest = PWManifest::get('tests/');
    expect($manifest['8331d2aa']->file)->toBe('assets/main-8331d2aa.js');
});

test('get token name', function () {

    $manifest = PWManifest::get('tests/');

    $class = new ReflectionClass(PWManifest::class);
    $get_token_name = $class->getMethod('get_token_name');
    $get_token_name->setAccessible(true);

    $token = $get_token_name->invokeArgs(new PWManifest(),
        [$manifest['8331d2aa']->file]);
    expect($token)->toBe('8331d2aa');

    $token = $get_token_name->invokeArgs(new PWManifest(),
        [$manifest['6fc5fb3f']->file]);
    expect($token)->toBe('6fc5fb3f');
});

test('keep only entries', function () {

    $class = new ReflectionClass(PWManifest::class);
    $keep_entries = $class->getMethod('keep_entries');
    $get_file = $class->getMethod('get_file');
    $keep_entries->setAccessible(true);
    $get_file->setAccessible(true);

    $manifest = $get_file->invokeArgs(new PWManifest(),
        ['tests/']);

    $cleaned = $keep_entries->invokeArgs(new PWManifest(),
        [$manifest]);

    foreach ($cleaned as $key => $value) {
        if (strpos($value->file, '.css') > 0) {
            continue;
        }
        expect($value->isEntry)->toBeTrue();
    }
});

test('get legacy and polyfill', function () {
    $class = new ReflectionClass(PWManifest::class);
    $move_legacy_and_polyfill = $class->getMethod('move_legacy_and_polyfill');
    $get_file = $class->getMethod('get_file');
    $move_legacy_and_polyfill->setAccessible(true);
    $get_file->setAccessible(true);

    $results = $move_legacy_and_polyfill->invokeArgs(new PWManifest(),
        [$get_file->invokeArgs(new PWManifest(),
            ['tests/'])]);

    expect(strpos($results['polyfill']->src, 'polyfills'))->not->toBeFalse();
    expect(strpos($results['polyfill']->src, 'legacy'))->not->toBeFalse();
    expect(strpos($results['legacy']->src, 'polyfills'))->toBeFalse();
    expect(strpos($results['legacy']->src, 'legacy'))->not->toBeFalse();
});

test('order manifest', function () {

    $class = new ReflectionClass(PWManifest::class);
    $order_manifest = $class->getMethod('order_manifest');
    $get_file = $class->getMethod('get_file');
    $order_manifest->setAccessible(true);
    $get_file->setAccessible(true);

    $manifest = $get_file->invokeArgs(new PWManifest(),
        ['tests/']);

    $results = $order_manifest->invokeArgs(new PWManifest(),
        [$manifest]);

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
