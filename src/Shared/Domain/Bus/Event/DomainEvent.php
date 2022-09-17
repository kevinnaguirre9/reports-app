<?php

namespace ReportsApp\Shared\Domain\Bus\Event;

/**
 * Class DomainEvent
 *
 * @package ReportsApp\Shared\Domain\Bus\Event
 */
abstract class DomainEvent implements Event
{
    /**
     * @var string
     */
    public const NAME = 'event';

    /**
     * @var EventId
     */
    protected EventId $eventId;

    /**
     * @var string
     */
    protected string $firedAt;

    /**
     *
     */
    protected function __construct()
    {
        $this->eventId = new EventId();

        $this->firedAt = date('Y-m-d H:i:s');
    }

    /**
     * @inheritDoc
     */
    public function getEventId(): EventId
    {
        return $this->eventId;
    }

    /**
     * @inheritDoc
     */
    public function getType() : string
    {
        return static::NAME;
    }

    /**
     * @inheritDoc
     */
    public function getFiredAt(): string
    {
        return $this->firedAt;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize() : array
    {
        return [
            'event_id'=> (string) $this->eventId,
            'type'=> $this->getType(),
            'fired_at'=> $this->firedAt,
            'body'=> $this->toArray()
        ];
    }
}
