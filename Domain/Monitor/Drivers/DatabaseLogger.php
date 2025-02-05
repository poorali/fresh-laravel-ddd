<?php

namespace Domain\Monitor\Drivers;

use Domain\Monitor\Models\Log;
use Monolog\Handler\AbstractProcessingHandler;
use Monolog\Logger;
use Monolog\LogRecord;

class DatabaseLogger
{
    /**
     * Create a custom Monolog instance.
     *
     * @return Logger
     */
    public function __invoke()
    {
        return new Logger('DatabaseLogger', [
            new DatabaseHandler()
        ]);
    }
}

class DatabaseHandler extends AbstractProcessingHandler
{
    protected function write(LogRecord $record): void
    {
        Log::create([
            'level' => $record->level->getName(),
            'message' => $record->message,
            'logged_at' => $record->datetime,
            'context' => json_encode($record->context),
            'extra' => json_encode($record->extra)
        ]);
    }
}
