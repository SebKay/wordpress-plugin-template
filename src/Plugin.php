<?php

namespace WPT;

use WPT\Concerns\Instanceable;

class Plugin
{
    use Instanceable;

    protected Logger $logger;

    public function logger(): Logger
    {
        return $this->logger ??= new Logger();
    }

    public function run(): void
    {
        add_action('plugins_loaded', function () {
            require_once WPT_DIR_PATH.'/inc/options.php';
        }, 10);
    }
}
