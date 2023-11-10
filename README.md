## Plugin Presswind

This plugin give you the ability to use methods of the Presswind directly in
your theme.

## PWVite

@arg port  
@arg path - from your theme root  
@arg position front|admin|editor - default front  
@arg is_ts - default false

```php
use PressWind\Helpers\PWVite;

PWVite::init(4444, 'admin', 'admin');
```

## PWConfig

```php
use PressWind\Helpers\PWConfig;

// get rss in array config. 
PWConfig::get('disable.rss');
```

## PWAssets

```php
use PressWind\Helpers\PWAssets;

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
