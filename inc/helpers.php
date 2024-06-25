<?php

namespace WPT\Helpers;

function setting(string $key, $default = false)
{
    return \get_option("wpt_{$key}", $default);
}
