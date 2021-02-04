<?php

namespace WPT;

class WPT
{
    const PLUGIN_NAME = 'WordPress Plugin Template';
    const PLUGIN_SLUG = 'wp-plugin-template';

    protected $dir_path;
    protected $dir_url;
    protected $install;

    /**
     * Set up
     */
    public function __construct() {
        $this->dir_path = \plugin_dir_path(__FILE__);
        $this->dir_url  = \plugin_dir_url(__FILE__);
        $this->install  = new Install( self::PLUGIN_SLUG);
    }

    /**
     * Run it all
     */
    public function run() {
        $this->install->init();
    }
}
