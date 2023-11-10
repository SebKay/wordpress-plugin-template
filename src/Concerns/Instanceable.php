<?php

namespace WPT\Concerns;

trait Instanceable
{
    protected static $instance;

    /**
     * @return static
     */
    public static function instance(...$args)
    {
        return static::$instance ??= new static(...$args);
    }
}
