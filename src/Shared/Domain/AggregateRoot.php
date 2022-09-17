<?php

namespace ReportsApp\Shared\Domain;

use ReportsApp\Shared\Domain\BaseEntity;

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
     *
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return array
     */
    final public function pullDomainEvents(): array
    {
        $domainEvents       = $this->domainEvents;
        $this->domainEvents = [];

        return $domainEvents;
    }

//    final protected function record(DomainEvent $domainEvent): void
//    {
//        $this->domainEvents[] = $domainEvent;
//    }
}
