<?php

namespace WPT\Processes;

use WPT\Enums\NoticeType;

use function WPT\toggleAdminNotice;

class BackgroundProcess extends \WPT_WP_Background_Process
{
    protected $action = 'wpt_background_process';

    /**
     * @param  array  $data
     * @return false
     */
    protected function task($data)
    {
        try {
            // Do something
        } catch (\Exception $e) {
            \error_log($e);

            \wptPlugin()->logger()->general()->error($e->getMessage());
        }

        return false;
    }

    public function cancel()
    {
        parent::cancel();

        toggleAdminNotice(NoticeType::Test, false);
    }

    public function complete()
    {
        toggleAdminNotice(NoticeType::Test, false);

        parent::complete();
    }
}
