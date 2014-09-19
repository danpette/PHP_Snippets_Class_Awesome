<?php

namespace Monolog\Handler;

use Monolog\Logger;
use Monolog\Formatter\NormalizerFormatter;

/**
 * Logs to a MySQL database.
 *
 * Example:
 * $database = new medoo('test');
 * use Monolog\Logger;
 * use Monolog\Handler\MySQLHandler;
 * $Log = new Logger('something');
 * $Log->pushHandler(new \Monolog\Handler\MySQLHandler($database,Logger::DEBUG));
 *
 */
class MySQLHandler extends AbstractProcessingHandler
{
    private $database;

    public function __construct($database, $level = Logger::DEBUG, $bubble = true)
    {
        $this->database = $database;
        parent::__construct($level, $bubble);
    }

    protected function write(array $record)
    {
        $this->database->insert('Log', [
            'channel' => $record['channel'],
            'level' => $record['level'],
            'message' => $record['formatted'],
            'time' => $record['datetime']->format('U')
        ]);
    }
}
