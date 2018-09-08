<?php

namespace WeWork\Laravel;

use Illuminate\Support\Facades\Log;
use Psr\Log\AbstractLogger;

class LogBridge extends AbstractLogger
{
    public function log($level, $message, array $context = [])
    {
        Log::log($level, $message, $context);
    }
}
