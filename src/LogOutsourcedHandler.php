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

        $logger = new Logger('name');
        $logger->pushHandler(new LogOutsourcedHandler('https://uri.to/your_log/outsourced_api'));
    }

    protected function write(array $record): void
    {
        $this->logOutsourcedLogger->log(strtolower($record['level_name']), $record['message'], $record['context'] + $record['extra']);
    }
}
