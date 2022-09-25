<?php

namespace ReportsApp\Shared\Infrastructure\Bus\Event\RabbitMq;

use Enqueue\Consumption\ChainExtension;
use Enqueue\SimpleClient\SimpleClient;
use Psr\Log\LoggerInterface;
use ReportsApp\Shared\Infrastructure\Bus\Event\RabbitMq\Extensions\LogProcessorExceptionExtension;
use ReportsApp\Shared\Infrastructure\Bus\Event\RabbitMq\Processor\EventTypeDelegateProcessor;

/**
 * Class RabbitMqDomainEventsConsumer
 *
 * @package ReportsApp\Shared\Infrastructure\Bus\Event\RabbitMq
 */
final class RabbitMqDomainEventsConsumer
{
    /**
     * @param SimpleClient $client
     * @param EventTypeDelegateProcessor $processor
     * @param LoggerInterface $logger
     */
    public function __construct(
        private SimpleClient               $client,
        private EventTypeDelegateProcessor $processor,
        private LoggerInterface            $logger,
    )
    {
    }

    /**
     * @return void
     * @throws \Exception
     */
    public function consume() : void
    {
        //Get configured queue
        $queue = $this->client
            ->getDriver()
            ->getConfig()
            ->getRouterQueue();

        $QueueConsumer = $this->client->getQueueConsumer();

        //bind queue to the event type processor delegator
        $QueueConsumer->bind($queue, $this->processor);

        //consume!
        $QueueConsumer->consume(new ChainExtension([
            new LogProcessorExceptionExtension($this->logger)
        ]));
    }
}
