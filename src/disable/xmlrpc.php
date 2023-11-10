<?php

namespace PressWind;

use PressWind\Helpers\PWConfig;

function init_disable_xmlrpc()
{
    if (PWConfig::get('disable.xmlrpc')) {
        // Disable XML RPC for security.
        add_filter('xmlrpc_enabled', '__return_false');
        add_filter('xmlrpc_methods', '__return_false');
        // Removes Really Simple Discovery link.
        remove_action('wp_head', 'rsd_link');
    }
}

init_disable_xmlrpc();
