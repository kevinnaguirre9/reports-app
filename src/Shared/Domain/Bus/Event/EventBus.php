<?php

namespace ReportsApp\Shared\Domain\Bus\Event;

/**
 * Interface EventBus
 *
 * @package ReportsApp\Shared\Domain\Bus\Event
 */
interface EventBus
{
    /**
     * @param Event ...$events
     * @return void
     */
    public function dispatch(Event ...$events): void;
}
