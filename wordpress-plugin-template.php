<?php
/*
    Plugin Name: WordPress Plugin Template
    Description: A simple template for writing WordPress plugins.
    Version: 0.2.0
    Requires PHP: 8.2
    Text Domain: wp-plugin-template
    Author: Seb Kay
    Author URI: http://sebkay.com
    WC requires at least: 6.0.0
    WC tested up to: 6.4.3
*/

defined('ABSPATH') or exit;

define('WPT_PLUGIN_NAME', 'WordPress Plugin Template');
define('WPT_PLUGIN_SLUG', 'wpt');
define('WPT_DIR_PATH', plugin_dir_path(__FILE__));
define('WPT_WP_ROOT', WPT_DIR_PATH.'/../../../');
define('WPT_LOGS', WPT_DIR_PATH.'/wpt-logs');

require_once WPT_DIR_PATH.'/vendor/autoload.php';

function wpt_plugin()
{
    return WPT\Plugin::instance();
}

wpt_plugin()->run();
