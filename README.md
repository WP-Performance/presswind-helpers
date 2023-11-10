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
use PressWind\Helpers\PwConfig;

// get rss in array config. 
PwConfig::get('disable.rss');
```
