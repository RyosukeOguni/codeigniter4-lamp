<?php

namespace App\Libraries;

trait LoggingTrait
{
    final protected function log(string $level, string $message, array $context = []): void
    {
        log_message($level, "({file}:{line}) $message", $context);
    }
}
