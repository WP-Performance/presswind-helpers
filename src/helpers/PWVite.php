<?php

namespace PressWind\Helpers;

use PressWind\Helpers\Base\CSSAsset;
use PressWind\Helpers\Base\JSAsset;

class PWVite
{
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
    'front', bool $is_ts = false)
    {
        $this->port = $port;
        $this->path = $path;
        $this->is_ts = $is_ts;
        $this->position = $position;

        $this->set_script();
    }

    /**
     * init vite asset
     *
     * @param  int  $port
     * @param  string  $path
     * @param  string  $position - front|admin|editor
     * @param  bool  $is_ts
     */
    public static function init($port = 3000, $path = '', $position = 'front', $is_ts = false)
    {
        return new self($port, $path, $position, $is_ts);
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
        PWAsset::add('presswind-script-dev', 'https://localhost:'.$this->port
                                             .'/'
                                             .$this->get_relative_path_from_wp_content().$this->path.'/main'.($this->is_ts ? '.ts' : '.js'))
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
        $_path = str_starts_with($this->path, '/') ? $this->path : '/'.$this->path;
        $_path = str_ends_with($_path, '/') ? $_path : $_path.'/';

        return get_template_directory_uri().$_path.self::$dist_path;
    }

    private function set_script_prod(): void
    {
        // get manifest files list by order
        $ordered = PWManifest::get($this->path);
        foreach ($ordered as $key => $value) {
            // if is css
            if (property_exists($value, 'css') === true || strpos($value->src, '.css') !== false) {
                if (strpos($value->src, '.css') > 0) {
                    $css = [$value->file];
                } else {
                    $css = $value->css;
                }
                $asset = PWAsset::add($this->slug.'-'.$key, $this->getPath().$css[0])
                    ->version($key)
                    ->setOnLoad();
                $this->setPosition($asset);

                // if is js
            } else {
                if (str_contains($value->file, 'polyfills-legacy')) {
                    // Legacy nomodule polyfills for dynamic imports for older browsers
                    $asset = PWAsset::add($this->slug.'-'.$key, $this->getPath().$value->file)
                        ->version($key)
                        ->inFooter()->nomodule();
                    $asset = $this->setPosition($asset);
                    $asset->withInline('
                      !function () {
                          var e = document, t = e.createElement("script");
                          if (!("noModule" in t) && "onbeforeload" in t) {
                            var n = !1;
                            e.addEventListener("beforeload", function (e) {
                              if (e.target === t) n = !0; else if (!e.target.hasAttribute("nomodule") || !n) return;
                              e.preventDefault()
                            }, !0), t.type = "module", t.src = ".", e.head.appendChild(t), t.remove()
                          }
                      }();', 'before');

                } elseif (str_contains($value->file, 'legacy')) {
                    // Legacy app.js script for legacy browsers
                    $asset = PWAsset::add($this->slug.'-'.$key, $this->getPath().$value->file)
                        ->version($key)
                        ->inFooter()
                        ->nomodule();
                    $this->setPosition($asset);

                } else {
                    // Modern app.js module for modern browsers
                    $asset = PWAsset::add($this->slug.'-'.$key,
                        $this->getPath().$value->file)
                        ->version($key)
                        ->inFooter()
                        ->module();
                    $this->setPosition($asset);
                }
            }
        }
    }

    /**
     * get path after wp-content
     */
    public function get_relative_path_from_wp_content(): string
    {
        // get content dir name
        $content_dir = explode('/', WP_CONTENT_DIR);
        $content_dir = end($content_dir);
        // split path from content dir name
        $_path_ = explode($content_dir, get_template_directory().$this->path);

        return count($_path_) > 0 ? $content_dir.$_path_[1] : '';
    }
}
