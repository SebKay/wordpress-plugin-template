<?php

namespace WPT\Crons;

use SebKay\WPCronable\WPCronable;
use WPT\Concerns\Instanceable;
use WPT\Processes\BackgroundProcess;

class CronJob extends WPCronable
{
    use Instanceable;

    protected string $wp_cron_name = 'wpt_cron_job';

    protected int $wp_cron_interval = 1800; // 30 mins

    public function __construct(
        protected $process = new BackgroundProcess(),
    ) {}

    public function run(): void
    {
        try {
            $items = \collect([]);

            if ($items->isEmpty()) {
                return;
            }

            $items
                ->chunk(10)
                ->each(function ($chunk) {
                    $chunk->each(function ($item) {
                        $this->process->push_to_queue([
                            'item' => $item,
                        ]);
                    });

                    $this->process->save();
                });

            $this->process->dispatch();
        } catch (\Exception $e) {
            \error_log($e);

            \wptPlugin()->logger()->general()->error($e->getMessage());
        }
    }
}
