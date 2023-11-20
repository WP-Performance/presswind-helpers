<?php
/*
Plugin Name: PressWind
Plugin URI:
Description: PressWind Starter Theme helpers
Version: 0.0.1
Tested up to: 6.3
Requires PHP: 8.1
Author: Patrick Faramaz
Author URI: https://wp-performance.com

    Copyright 2023 Patrick Faramaz

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

use PressWind\PWVite;

if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

require_once dirname(__FILE__).'/vendor/autoload.php';

require_once dirname(__FILE__).'/src/disable/feed.php';
require_once dirname(__FILE__).'/src/disable/comment.php';
require_once dirname(__FILE__).'/src/disable/emoji.php';
require_once dirname(__FILE__).'/src/disable/media.php';
require_once dirname(__FILE__).'/src/disable/oembed.php';
require_once dirname(__FILE__).'/src/disable/xmlrpc.php';
require_once dirname(__FILE__).'/src/disable/rest_user.php';
require_once dirname(__FILE__).'/src/disable/jquery.php';

PWVite::init();
