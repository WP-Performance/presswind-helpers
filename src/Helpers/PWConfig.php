<?php

namespace PressWind\Helpers;

/**
 * Class PWConfig
 */
class PWConfig
{
    private static ?PWConfig $instance = null;

    /**
     * @var string - path to global config
     */
    public static string $global_path = '/config';

    /**
     * @var string - path to default config
     */
    public static string $default_path = '';

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
        $default = file_get_contents(plugin_dir_path(__DIR__).self::$default_path.'default.json');
        // convert to array
        $default = json_decode($default, true);

        $global = [];
        // theme values if exist
        if(file_exists(get_stylesheet_directory().self::$global_path.'/global.json')) {
            $global = file_get_contents(get_stylesheet_directory().self::$global_path.'/global.json');
            $global = json_decode($global, true);
        }

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
