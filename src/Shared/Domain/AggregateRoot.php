<?php

namespace ReportsApp\Shared\Domain;

use ReportsApp\Shared\Domain\Bus\Event\DomainEvent;

/**
 * Class AggregateRoot
 *
 * @package ReportsApp\Shared\Domain
 */
abstract class AggregateRoot extends BaseEntity
{
    /**
     * @var array
     */
    private array $domainEvents = [];

    /**
     * @return DomainEvent[]
     */
    final public function pullDomainEvents(): array
    {
        $domainEvents       = $this->domainEvents;

        $this->domainEvents = [];

        return $domainEvents;
    }

    /**
     * @param DomainEvent $domainEvent
     * @return void
     */
    final protected function record(DomainEvent $domainEvent): void
    {
        $this->domainEvents[] = $domainEvent;
    }
}
