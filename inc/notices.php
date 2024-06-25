<?php

namespace WPT;

use WPT\Enums\NoticeType;

use function WPT\Helpers\setting;

function adminNotices()
{
    return [
        NoticeType::Test->value => [
            'enabled' => setting('notice_for_'.NoticeType::Test->value, false),
            'type' => 'info',
            'text' => __('This is a test notice.', 'wp-plugin-template'),
        ],
    ];
}

function toggleAdminNotice(NoticeType $type, $enabled = true)
{
    return \update_option("wpt_notice_for_{$type->value}", $enabled);
}

function displayAdminNotices()
{
    $html = '';

    \collect(adminNotices())
        ->each(function ($notice) use (&$html) {
            if ($notice['enabled']) {
                $html .= <<< EOT
                    <div class='notice notice-{$notice['type']}'>
                        <p>{$notice['text']}</p>
                    </div>
                EOT;
            }
        });

    echo $html;
}

add_action('admin_notices', 'WPT\displayAdminNotices');
