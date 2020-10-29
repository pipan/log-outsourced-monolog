<?php

namespace LogOutsourcedMonolog;

use Monolog\Handler\AbstractProcessingHandler;
use Monolog\Logger;
use OutsourcedSdk\HttpOutsourced;

class LogOutsourcedHandler extends AbstractProcessingHandler
{
    private $outsourced;

    public function __construct($host, $accessKey, $level = Logger::DEBUG, bool $bubble = true)
    {
        parent::__construct($level, $bubble);
        $this->outsourced = HttpOutsourced::makeWithGuzzle([
            'host' => $host,
            'accessKey' => $accessKey
        ]);
        
    }

    protected function write(array $record): void
    {
        $this->outsourced->logSingle(strtolower($record['level_name']), $record['message'], $record['context'] + $record['extra']);
    }
}
