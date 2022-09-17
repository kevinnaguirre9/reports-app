<?php

namespace ReportsApp\Shared\Infrastructure\Bus\Command;

use League\Tactician\CommandBus as TacticianCommandBus;
use ReportsApp\Shared\Domain\Bus\Command\CommandBus as CommandBusContract;
use ReportsApp\Shared\Domain\Bus\Command\Command;

/**
 * Class SyncCommandBus
 *
 * @package ReportsApp\Shared\Infrastructure\Bus\Command
 */
final class SyncCommandBus implements CommandBusContract
{
    /**
     * @param TacticianCommandBus $commandBus
     */
    public function __construct(private TacticianCommandBus $commandBus)
    {
    }

    /**
     * @param Command $command
     * @return void
     */
    public function dispatch(Command $command): void
    {
        $this->commandBus->handle($command);
    }
}
