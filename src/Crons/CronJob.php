<?php

namespace WPT\Crons;

use SebKay\WPCronable\WPCronable;
use WPT\Concerns\Instanceable;
use WPT\Enums\NoticeType;
use WPT\Processes\BackgroundProcess;

use function WPT\toggleAdminNotice;

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
            toggleAdminNotice(NoticeType::Test);

            $items = \collect([]);

            if ($items->isEmpty()) {
                toggleAdminNotice(NoticeType::Test, false);

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
            toggleAdminNotice(NoticeType::Test, false);

            \error_log($e);

            \wptPlugin()->logger()->general()->error($e->getMessage());
        }
    }
}
