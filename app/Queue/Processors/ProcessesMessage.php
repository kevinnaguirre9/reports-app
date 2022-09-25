<?php

namespace App\Queue\Processors;

use Interop\Queue\Message;
use Psr\Log\LoggerInterface;
use ReportsApp\Shared\Application\Command\Command;
use ReportsApp\Shared\Domain\Bus\Command\CommandBus;

/**
 * Trait ProcessesMessage
 *
 * @package App\Queue\Processors
 */
trait ProcessesMessage
{
    /**
     * @param CommandBus $commandBus
     * @param LoggerInterface $logger
     */
    public function __construct(
        private CommandBus $commandBus,
        private LoggerInterface $logger,
    )
    {
    }

    /**
     * Gets message body as an array
     *
     * @param Message $message
     * @return array
     */
    protected function getMessagePayload(Message $message): array
    {
        return json_decode($message->getBody(), true);
    }

    /**
     * @param Command $command
     * @return void
     */
    protected function handleCommand(Command $command)
    {
        $this->commandBus->dispatch($command);
    }
}
