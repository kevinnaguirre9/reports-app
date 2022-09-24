<?php

namespace ReportsApp\Shared\Infrastructure\Bus\Event\MongoDb;

use Doctrine\ODM\MongoDB\DocumentManager;
use MongoDB\Database;
use ReportsApp\Shared\Domain\Bus\Event\Event;
use ReportsApp\Shared\Domain\Bus\Event\EventBus;

/**
 * Class MongoDbEventBus
 *
 * @package ReportsApp\Shared\Infrastructure\Bus\Event\MongoDb
 */
final class MongoDbEventBus implements EventBus
{
    /**
     * Collection name for failed events
     */
    private const DOMAIN_EVENTS_COLLECTION = 'domain_events';

    /**
     * @var Database
     */
    private Database $MongoDbConnection;

    /**
     * @param DocumentManager $documentManager
     */
    public function __construct(private DocumentManager $documentManager)
    {
        $this->MongoDbConnection = $this->documentManager
            ->getClient()
            ->selectDatabase(env('DB_DATABASE_MONGO'));
    }

    /**
     * @param Event ...$events
     * @return void
     */
    public function dispatch(Event ...$events): void
    {
        $events = array_map($this->mapEventToCollectionFormat(), $events);

        $this->publishEvents($events);
    }

    /**
     * @param array $events
     * @return void
     */
    private function publishEvents(array $events)
    {
        $this->MongoDbConnection
            ->selectCollection(self::DOMAIN_EVENTS_COLLECTION)
            ->insertMany($events);
    }

    /**
     * @return \Closure
     */
    private function mapEventToCollectionFormat(): \Closure
    {
        return function(Event $event) {

            return [
                'event_id'  => (string) $event->getEventId(),
                'type'      => $event->getType(),
                'fired_at'  => $event->getFiredAt(),
                'body'      => $event->jsonSerialize(),
            ];

        };
    }
}
