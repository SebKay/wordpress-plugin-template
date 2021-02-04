<?php

namespace WPT;

class Install
{
    protected $plugin_slug;

    /**
     * Set up
     *
     * @param string $plugin_slug
     */
    public function __construct( string $plugin_slug ) {
        $this->plugin_slug = $plugin_slug;
    }

    /**
     * Check if the plugin was just activated
     */
    protected function isJustActivated() {
        if ( \get_option('wpt_plugin_loaded') == $this->plugin_slug ) {
            return true;
        }
    }

    /**
     * Remove the option used to check for activation
     */
    protected function removeActivationCheck() {
        \delete_option('wpt_plugin_loaded');
    }

    /**
     * Add settings defaults
     */
    protected function installPresets() {
        \update_option('wpt_test_option', 'Yas');
    }

    /**
     * Run it all
     */
    public function init() {
        if ( !\is_admin() ) {
            return;
        }

        if ( !$this->isJustActivated() ) {
            return;
        }

        $this->removeActivationCheck();

        $this->installPresets();
    }
}
