<?php

namespace WPT\Processes;

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
}
