## Presswind Vite JS Assets helpers for WordPress

This code give you the ability to use methods of the Presswind directly in
your theme for use Vite JS.

Find the package on [Packagist](https://packagist.org/packages/wp-performance/presswind-assets)


## PWVite

port - default 3000  
path - from your theme root  
position front|admin|editor - default front  
is_ts - default false  
is_plugin true|false - default false - for search assets in plugin folder  
instead of theme folder  
slug - handle - default presswind-script  
is_https - default true - for https or http  
main_file - default main - file name without extension  

```php
use PressWind\PWVite;

// use with named parameters for more readability

// in theme
// 1 - search dist folder in root theme
PWVite::init(port: 3000, path: '');

// 2 - search admin/dist folder in root theme
PWVite::init(port: 4444, path: 'admin', position: 'admin', is_ts: false);

// in plugin

// 3 - search dist folder in plugin test-plugin (from index.php root plugin)
PWVite::init( port: 7777, path: 'test-plugin/', plugin_path: __FILE__, slug:
'plugin-test' );

```

## Preload fonts

```php
PWVite::init()->setPreloadFont();
```

## PWAssets

```php
use PressWind\PWAssets;

// for css
PWAsset::add('my-css', get_template_directory_uri().'/assets/style.css')->dependencies([])->media('all')->version('1.0.0')->toFront();
PWAsset::add('my-css', get_template_directory_uri().'/assets/style.css')->dependencies([])->media('all')->version('1.0.0')->toBack();
PWAsset::add('my-css', get_template_directory_uri().'/assets/style.css')->dependencies([])->media('all')->version('1.0.0')->toBlock();
PWAsset::add('my-css', get_template_directory_uri().'/assets/style.css')->dependencies([])->media('all')->version('1.0.0')->toLogin();


// for js
PWAsset::add('my-js', get_template_directory_uri().'/assets/js/app.js')
    ->dependencies(['jquery'])
    ->version('1.0.0')
    ->module()
    ->toFront()
    ->withInline('console.log("hello world")');

PWAsset::add('my-js', get_template_directory_uri().'/assets/js/app.js')
    ->dependencies(['jquery'])
    ->version('1.0.0')
    ->noModule()
    ->toFront();

PWAsset::add('my-js', get_template_directory_uri().'/assets/js/app.js')
    ->dependencies(['jquery'])
    ->version('1.0.0')
    ->async()
    ->inFooter()
    ->toFront();

PWAsset::add('my-js', get_template_directory_uri().'/assets/js/app.js')
    ->dependencies(['jquery'])
    ->version('1.0.0')
    ->defer()
    ->inFooter()
    ->toFront();

PWAsset::add('my-js', get_template_directory_uri().'/assets/js/app.js')
    ->dependencies(['jquery'])
    ->version('1.0.0')
    ->defer()
    ->inFooter()
    ->toBack();

PWAsset::add('my-js', get_template_directory_uri().'/assets/js/app.js')
    ->dependencies(['jquery'])
    ->version('1.0.0')
    ->defer()
    ->inFooter()
    ->toBlock();
```
