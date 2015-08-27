<?php

namespace Elcweb\Monolog\FluentdBundle\Monolog\Handler;

use Fluent\Logger\FluentLogger;
use Monolog\Handler\AbstractProcessingHandler;
use Monolog\Formatter\JsonFormatter;
use Monolog\Logger;

/**
 * Class MonologFluentdHandler
 * @package Elcweb\Monolog\FluentdBundle\Monolog\Handler
 */
class MonologFluentdHandler extends AbstractProcessingHandler
{
    /** @var \Elcweb\Monolog\FluentdBundle\Monolog\Handler\FluentLogger  */
    private $logger;

    /** @var int  */
    private $port;

    /** @var bool|string  */
    private $host;

    /**
     * @param           $port
     * @param           $host
     * @param           $level
     * @param bool|true $bubble
     * @param string    $env
     * @param string    $tag
     */
    public function __construct(
        $port = FluentLogger::DEFAULT_LISTEN_PORT,
        $host = FluentLogger::DEFAULT_ADDRESS,
        $level = Logger::DEBUG,
        $bubble = true,
        $env = 'dev_ak',
        $tag = 'backend'
    ) {
        $this->port = $port;
        $this->host = $host;
        $this->env = $env;
        $this->tag = $tag;

        parent::__construct($level, $bubble);

        $this->logger = new FluentLogger($host, $port);
    }

    /**
     * {@inheritdoc}
     */
    public function handleBatch(array $records)
    {
        $messages = array();

        foreach ($records as $record) {
            if ($record['level'] < $this->level) {
                continue;
            }
            $messages[] = $this->processRecord($record);
        }

        if (!empty($messages)) {
            foreach($messages as $message) {
                $this->write($message);
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function write(array $record)
    {
        if (isset($record['context']) && isset($record['context']['tag'])) {
            $tag = $record['context']['tag'];
        } else {
            $tag  = $this->tag;
        }
        $tag = $tag . '.' . $this->env;

        $data = $record;
        $data['level'] = Logger::getLevelName($record['level']);

        $this->logger->post($tag, $data);
    }

    /**
     * {@inheritDoc}
     */
    protected function getDefaultFormatter()
    {
        return new JsonFormatter();
    }
}
