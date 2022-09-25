<?php

namespace App\Queue\Processors;

use Interop\Queue\Context;
use Interop\Queue\Message;
use Interop\Queue\Processor;

/**
 * Class NullProcessor
 *
 * @package App\Queue\Processors
 */
final class NullProcessor implements Processor
{
    use ProcessesMessage;

    /**
     * @inheritDoc
     */
    public function process(Message $message, Context $context): object|string
    {
        $this->logger->info("Event {$message->getHeader('type')} received");

        var_dump($this->getMessagePayload($message));

        return self::ACK;
    }
}
