<?php

namespace PressWind;

// Redirects all feeds to home page.
use PressWind\Helpers\PWConfig;

function disable_feeds_rss(): void
{
    wp_redirect(site_url());
}

function init_disable_feed()
{
    if (PWConfig::get('disable.rss')) {
        // Disables feeds.
        add_action('do_feed', __NAMESPACE__.'\disable_feeds_rss', 1);
        add_action('do_feed_rdf', __NAMESPACE__.'\disable_feeds_rss', 1);
        add_action('do_feed_rss', __NAMESPACE__.'\disable_feeds_rss', 1);
        add_action('do_feed_rss2', __NAMESPACE__.'\disable_feeds_rss', 1);
        add_action('do_feed_atom', __NAMESPACE__.'\disable_feeds_rss', 1);

        // Removes RSS feed links.
        remove_action('wp_head', 'feed_links', 2);

        // Removes all extra RSS feed links.
        remove_action('wp_head', 'feed_links_extra', 3);
    }
}

init_disable_feed();
