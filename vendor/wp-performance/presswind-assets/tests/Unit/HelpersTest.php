<?php

test('no slash start', function () {
    $path = 'test';
    $clean_path = PressWind\PWHelpers::cleanPath($path);
    expect($clean_path)->toBe('/test/');
});

test('no slash end', function () {
    $path = '/test';
    $clean_path = PressWind\PWHelpers::cleanPath($path);
    expect($clean_path)->toBe('/test/');
});

test('slash start and end', function () {
    $path = '/test/';
    $clean_path = PressWind\PWHelpers::cleanPath($path);
    expect($clean_path)->toBe('/test/');
});

test('only slash at end', function () {
    $path = 'test/';
    $clean_path = PressWind\PWHelpers::cleanPath($path);
    expect($clean_path)->toBe('/test/');
});

test('no slash end param with no slash input', function () {
	$path = 'test';
	$clean_path = PressWind\PWHelpers::cleanPath($path, false);
	expect($clean_path)->toBe('/test');
});

test('no slash end param with slash input', function () {
	$path = '/test/';
	$clean_path = PressWind\PWHelpers::cleanPath($path, false);
	expect($clean_path)->toBe('/test');
});
