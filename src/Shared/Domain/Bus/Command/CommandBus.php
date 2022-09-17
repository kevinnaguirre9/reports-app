<?php

namespace ReportsApp\Shared\Domain\Bus\Command;

/**
 * Interface CommandBus
 *
 * @package ReportsApp\Shared\Domain\Bus\Command
 */
interface CommandBus
{
    /**
     * @param Command $command
     * @return void
     */
    public function dispatch(Command $command) : void;
}
