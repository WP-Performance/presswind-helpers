## Presswind Helpers

This plugin give you the ability to use Vite JS directly in
your theme.

You can use this plugin with the starter theme **Press-wind**:
<https://github.com/WP-Performance/press-wind>

## Steps to Use

1. Install the **presswind-helpers** plugin.
2. Install the **Press-wind** theme.
3. Start coding!

## PWVite

- port - default 3000
- path - from your theme root
- position front|admin|editor - default front
- is_ts - default false
- is_plugin true|false - default false - for search assets in plugin folder instead of theme folder
- slug - handle - default presswind-script

```php
if (class_exists('PressWind\PWVite')) {
// use with named parameters for more readability

// in theme
// 1 - search dist folder in root theme
\PressWind\PWVite::init(port: 3000, path: '');

// 2 - search admin/dist folder in root theme
\PressWind\PWVite::init(port: 4444, path: 'admin', position: 'admin', is_ts: false);

// in plugin

// 3 - search dist folder in plugin test-plugin
\PressWind\PWVite::init( port: 7777, path: 'test-plugin/', is_plugin: true, slug:
'plugin-test' );

}

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

## License

PressWind Helper is released under the terms of the GNU General Public License version 2 or (at your option) any later version. See [LICENSE.md](LICENSE.md) for complete license.
