<?php

namespace PressWind\Helpers;

class PWApp
{
    public static function isDev(): bool
    {
        return defined('WP_ENV') && WP_ENV === 'development';
    }
}
