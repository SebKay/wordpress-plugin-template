<?php

namespace WPT;

use Monolog\Formatter\LineFormatter;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Level;
use Monolog\Logger as MonologLogger;

class Logger
{
    protected LineFormatter $formatter;

    protected MonologLogger $general;

    public function __construct()
    {
        $this->formatter = new LineFormatter(
            "[%datetime%] %channel%.%level_name%: %message% %context% %extra%\n",
            'Y-m-d H:i:s'
        );
    }

    public function general(): MonologLogger
    {
        return $this->general ??= (new MonologLogger('WordPress Plugin Template - General'))->pushHandler(
            (new RotatingFileHandler(
                \WPT_LOGS.'/general/general.log',
                Level::Debug->value
            ))->setFormatter($this->formatter)
        );
    }
}
