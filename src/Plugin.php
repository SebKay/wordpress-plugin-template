<?php

namespace WPT;

use SebKay\WPCronable\Helpers;
use WPT\Concerns\Instanceable;
use WPT\Crons\CronJob;

class Plugin
{
    use Instanceable;

    protected Logger $logger;

    public function logger(): Logger
    {
        return $this->logger ??= new Logger();
    }

    public function options(): void
    {
        \add_action('admin_menu', function () {
            if (! \current_user_can('administrator')) {
                return;
            }

            \add_submenu_page(
                'options-general.php',
                \WPT_PLUGIN_NAME,
                \WPT_PLUGIN_NAME,
                'manage_options',
                'wpt-settings',
                fn () => include \WPT_DIR_PATH.'/inc/options.php'
            );
        }, 10);

        \add_action('admin_init', function () {
            \register_setting('wpt-options', 'wpt_cron_enabled');
            \register_setting('wpt-options', 'wpt_text_option');
            \register_setting('wpt-options', 'wpt_radio_option');
            \register_setting('wpt-options', 'wpt_select_option');
        }, 10);
    }

    public function cronSchedules(): void
    {
        add_filter('cron_schedules', function (array $schedules): array {
            \collect(Helpers::wpCronIntervals())->each(function (array $interval) use (&$schedules) {
                $schedules[$interval['slug']] = [
                    'interval' => $interval['value'] ?? '',
                    'display' => $interval['label'] ?? '',
                ];
            });

            return $schedules;
        }, );
    }

    public function cronJob(): CronJob
    {
        return CronJob::instance();
    }

    public function run(): void
    {
        \add_action('plugins_loaded', function (): void {
            $this->options();
            $this->cronSchedules();

            if (! \get_option('wpt_cron_enabled', 0)) {
                $this->cronJob()->unscheduleCron();
            } else {
                $this->cronJob()->scheduleCron();
            }
        }, 10);
    }
}
