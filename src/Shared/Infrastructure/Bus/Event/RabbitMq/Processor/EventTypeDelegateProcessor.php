<?php

namespace ReportsApp\Shared\Infrastructure\Bus\Event\RabbitMq\Processor;

use Enqueue\ProcessorRegistryInterface;
use Interop\Queue\{Context, Message, Processor};

/**
 * Class EventTypeDelegateProcessor
 *
 * @package ReportsApp\Shared\Infrastructure\Bus\Event\RabbitMq\Processor
 */
final class EventTypeDelegateProcessor implements Processor
{
    /**
     * Event type header
     */
    private const EVENT_TYPE_HEADER = 'type';

    /**
     * @param ProcessorRegistryInterface $registry
     */
    public function __construct(private ProcessorRegistryInterface $registry)
    {
    }

    /**
     * @inheritDoc
     *
     * @throws \Exception
     */
    public function process(Message $message, Context $context): object|string
    {
        $processorName = $message->getHeader(self::EVENT_TYPE_HEADER);

        if(!$processorName)
            throw new \Exception("Event type header not configured in incoming event.");

        return $this->registry->get($processorName)->process($message, $context);
    }
}
