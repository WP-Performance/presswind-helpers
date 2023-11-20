<?php

namespace PressWind;

function init_disable_oembed()
{
    if (PWConfig::get('disable.oembed')) {
        // Removes oEmbeds.
        remove_action('wp_head', 'wp_oembed_add_discovery_links', 10);
        remove_action('wp_head', 'wp_oembed_add_host_js');
    }
}

init_disable_oembed();
