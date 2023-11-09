<?php

namespace PressWind\Helpers;

/**
 * Class PwConfig
 */
class PwConfig
{
    private static ?PwConfig $instance = null;

    private static array $config = [];

    private function __construct()
    {
        self::$config = $this->init();
    }

    /**
     * create config global
     */
    private function init(): array
    {
        // default values
        $default = file_get_contents(get_template_directory().'/src/default.json');
        // theme values
        $global = file_get_contents(get_template_directory().'/config/global.json');

        // convert to array
        $default = json_decode($default, true);
        $global = json_decode($global, true);

        // override default value
        return array_replace_recursive($default, $global);
    }

    /**
     * get element in config global
     */
    public static function get(string $key): string|bool|array|int|null
    {
        if ($key === '') {
            throw new \Exception('key is empty');
        }

        if (self::$instance === null) {
            self::$instance = new self();
        }

        // recursive search in array with dot notation
        // $key = 'disable.rss'
        // $key = ['disable', 'rss']
        $key = explode('.', $key);
        $config = self::$instance::$config;
        foreach ($key as $k) {
            if (isset($config[$k])) {
                $config = $config[$k];
            } else {
                return null;
            }
        }

        return $config;
    }

    /**
     * get config global
     */
    public static function getAll(): ?array
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance::$config;
    }
}
