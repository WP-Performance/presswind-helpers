<?php

namespace PressWind;

use PressWind\Base\CSSAsset;
use PressWind\Base\JSAsset;

class PWVite
{
    private bool $is_plugin = false;

    private int $port = 3000;

    private string $slug = 'presswind-script';

    private string $path = '';

    private bool $is_ts = false;

    /**
     * @var string front|admin|editor
     */
    private string $position = 'front';

    private static string $dist_path = 'dist/';

    /**
     * PWVite constructor.
     *
     * @param  string  $position - front|admin|editor
     */
    private function __construct(int $port, string $path, string $position =
    'front', bool $is_ts = false, bool $is_plugin = false, string $slug = 'presswind-script')
    {
        $this->port = $port;
        $this->path = $path;
        $this->is_ts = $is_ts;
        $this->position = $position;
        $this->is_plugin = $is_plugin;
        $this->slug = $slug;

        $this->set_script();
    }

    /**
     * init vite asset
     *
     * @param  string  $position - front|admin|editor
     */
    public static function init(
        int $port = 3000,
        string $path = '',
        string $position =
        'front',
        bool $is_ts = false,
        $is_plugin = false,
        $slug = 'presswind-script'
    ) {
        return new self($port, $path, $position, $is_ts, $is_plugin, $slug);
    }

    private function set_script(): void
    {
        if (PWApp::isDev()) {
            $this->set_script_dev();
        } else {
            $this->set_script_prod();
        }
    }

    private function set_script_dev(): void
    {
        PWAsset::add('presswind-script-dev', 'https://localhost:' . $this->port . '/' . $this->get_relative_path_from() . $this->path . '/main' . ($this->is_ts ? '.ts' : '.js'))
            ->inFooter()->module()->toFront();
    }

    /**
     * set position for asset
     */
    private function setPosition(JSAsset|CSSAsset $asset): JSAsset|CSSAsset
    {
        if ($this->position === 'admin') {
            $asset->toBack();
        } elseif ($this->position === 'editor') {
            $asset->toBlock();
        } else {
            $asset->toFront();
        }

        return $asset;
    }

    private function getPath(): string
    {
        // add slash start if not exist
        $_path = str_starts_with($this->path, '/') ? $this->path : '/' . $this->path;
        $_path = str_ends_with($_path, '/') ? $_path : $_path . '/';

        return PWApp::get_working_url($this->is_plugin) . $_path . self::$dist_path;
    }

    private function set_script_prod(): void
    {
        // get manifest files list by order
        $ordered = PWManifest::getOrdered($this->path, $this->is_plugin);
        foreach ($ordered as $key => $value) {
            // if is css
            if (property_exists($value, 'css') === true || strpos($value->src, '.css') !== false) {
                $asset = PWAsset::add($this->slug . '-' . $key, $this->getPath() . $value->file)
                    ->version($key)
                    ->setOnLoad();
                $this->setPosition($asset);

                // if is js
            } else {
                if (str_contains($value->file, 'polyfills-legacy')) {
                    // Legacy nomodule polyfills for dynamic imports for older browsers
                    $asset = PWAsset::add($this->slug . '-' . $key, $this->getPath() . $value->file)
                        ->version($key)
                        ->inFooter()->nomodule();
                    $asset = $this->setPosition($asset);
                    $asset->withInline(PWConfig::get('vite-js-inline'), 'before');
                } elseif (str_contains($value->file, 'legacy')) {
                    // Legacy app.js script for legacy browsers
                    $asset = PWAsset::add($this->slug . '-' . $key, $this->getPath() . $value->file)
                        ->version($key)
                        ->inFooter()
                        ->nomodule();
                    $this->setPosition($asset);
                } else {
                    // Modern app.js module for modern browsers
                    $asset = PWAsset::add(
                        $this->slug . '-' . $key,
                        $this->getPath() . $value->file
                    )
                        ->version($key)
                        ->inFooter()
                        ->module();
                    $this->setPosition($asset);
                }
            }
        }
    }

    public function setPreloadFont(): void
    {
        if (!PWApp::isDev()) {
            $files = PWManifest::get($this->path, $this->is_plugin);
            $t = '';
            foreach ($files as $key => $value) {
                // only fonts directory
                if (str_contains($key, 'fonts') === false) {
                    continue;
                }
                // get extension file
                $ext = pathinfo($value->file, PATHINFO_EXTENSION);
                $t .= '<link rel="preload" href="' . $this->getPath() . $value->file . '" as="font" type="font/' . $ext . '" crossorigin />';
            }
            if ($t !== '') {
                add_action('wp_head', function () use ($t) {
                    echo $t;
                }, 1);
            }
        }
    }

    /**
     * get path after wp-content
     */
    public function get_relative_path_from(): string
    {
        if ($this->is_plugin) {

            $content_dir = explode('/', WP_PLUGIN_DIR);
            $content_dir = end($content_dir);
            $_path_ = explode($content_dir, plugin_dir_path(__DIR__) . $this->path);
        } else {
            // get content dir name
            $content_dir = explode('/', WP_CONTENT_DIR);
            $content_dir = end($content_dir);
            // split path from content dir name
            $_path_ = explode($content_dir, get_stylesheet_directory() . $this->path);
        }

        return count($_path_) > 0 ? $content_dir . $_path_[1] : '';
    }
}
