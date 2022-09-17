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
     * @param DomainEvent $event
     * @return void
     */
    public function publish(DomainEvent $event): void;
}
