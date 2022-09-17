<?php

namespace ReportsApp\Shared\Domain\Bus\Event;

use Illuminate\Contracts\Support\Arrayable;

/**
 * Interface Event
 *
 * @package ReportsApp\Shared\Domain\Bus\Event
 */
interface Event extends \JsonSerializable, Arrayable
{
    /**
     * Get the Event UUID
     *
     * @return EventId
     */
    public function getEventId() : EventId;

    /**
     * Get the event type
     *
     * @return string
     */
    public function getType(): string;

    /**
     * Get the DateTime the event was fired.
     *
     * @return string
     */
    public function getFiredAt(): string;
}
