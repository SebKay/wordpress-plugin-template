<?php
/*
    Plugin Name: WordPress Plugin Template
    Description: A simple template for making OOP WordPress plugins.
    Version: 0.1.0
    Requires PHP: 7.4
    Text Domain: wp-plugin-template
    Author: Seb Kay
    Author URI: http://www.sebkay.com
*/

defined('ABSPATH') or die('No script kiddies please!');

/**
 * Autoloader for dependencies
 */
$wpt_autoload_file = __DIR__ . '/vendor/autoload.php';

if ( is_file($wpt_autoload_file) ) {
    require_once $wpt_autoload_file;
}

/**
 * Config
 */
$wpt_plugin = new \WPT\WPT();

/**
 * Add option when plugin is activated
 */
register_activation_hook(__FILE__, function() use ( $wpt_plugin ) {
    add_option('wpt_plugin_loaded', $wpt_plugin::PLUGIN_SLUG);
});

/**
 * Run plugin
 */
$wpt_plugin->run();
