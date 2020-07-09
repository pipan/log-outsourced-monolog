<?php

namespace LogOutsourcedMonolog;

use LogOutsourcedSdk\LogOutsourcedFacade;
use Monolog\Handler\AbstractProcessingHandler;
use Monolog\Logger;

class LogOutsourcedHandler extends AbstractProcessingHandler
{
    private $logOutsourcedLogger;

    public function __construct($logOutsourcedApiUri, $level = Logger::DEBUG, bool $bubble = true)
    {
        $this->logOutsourcedLogger = LogOutsourcedFacade::createLogger($logOutsourcedApiUri);
        parent::__construct($level, $bubble);
    }

    protected function write(array $record): void
    {
        $this->logOutsourcedLogger->log(strtolower($record['level_name']), $record['message'], $record['context'] + $record['extra']);
    }
}
