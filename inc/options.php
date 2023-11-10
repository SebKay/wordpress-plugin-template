<?php

defined('ABSPATH') or exit;

/**
 * Create options page
 */
function wpt_create_options_page()
{
    if (! current_user_can('administrator')) {
        return;
    }

    add_submenu_page(
        'options-general.php',
        WPT_PLUGIN_NAME,
        WPT_PLUGIN_NAME,
        'manage_options',
        'wpt-settings',
        fn () => include WPT_DIR_PATH.'/inc/options-content.php'
    );
}

add_action('admin_menu', 'wpt_create_options_page');

/**
 * Register custom options
 */
function wpt_register_options()
{
    register_setting('wpt-options', 'wpt_text_option');
    register_setting('wpt-options', 'wpt_radio_option');
    register_setting('wpt-options', 'wpt_select_option');
}

add_action('admin_init', 'wpt_register_options');
