<?php

namespace WPT\Helpers;

function setting(string $key, $default = null)
{
    return \get_option(option: "wpt_{$key}", default: $default);
}
