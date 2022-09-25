<?php

namespace App\Console\Commands;

use Doctrine\ODM\MongoDB\DocumentManager;
use Illuminate\Console\Command;
use MongoDB\Collection;
use MongoDB\Database;
use Psr\Log\LoggerInterface;
use ReportsApp\Shared\Domain\Bus\Event\Event;
use ReportsApp\Shared\Domain\Bus\Event\EventBus;
use ReportsApp\Shared\Domain\Bus\Event\EventId;

/**
 * Class DispatchFailedEvents
 *
 * @package App\Console\Commands
 */
final class DispatchFailedEvents extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'event:dispatch {--L|limit=}';

    /**
     * The console command description.
     */
    protected $description = 'Dispatch failed events to the configured topic';

    /**
     * Collection name for failed events
     */
    private const DOMAIN_EVENTS_COLLECTION = 'domain_events';

    /**
     * Default limit for dispatching failed events
     */
    private const DISPATCH_EVENTS_LIMIT = 25;

    /**
     * @var Collection
     */
    private Collection $MongoDbDomainEventsCollection;

    /**
     * @param DocumentManager $documentManager
     * @param EventBus $eventBus
     */
    public function __construct(
        DocumentManager $documentManager,
        private EventBus $eventBus,
    )
    {
        $this->MongoDbDomainEventsCollection = $documentManager
            ->getClient()
            ->selectCollection(env('DB_DATABASE_MONGO'), self::DOMAIN_EVENTS_COLLECTION);

        parent::__construct();
    }

    /**
     * @return void
     */
    public function handle()
    {
        $totalFailedEvents = $this->MongoDbDomainEventsCollection->countDocuments();

        $this->info("Dispatching {$totalFailedEvents} failed events");

        $limit = $this->option('limit') ?? self::DISPATCH_EVENTS_LIMIT;

        $totalFailedEventsDispatched = 0;

        $offset = 0;

        while($totalFailedEventsDispatched < $totalFailedEvents) {

            $failedEvents = $this->searchFailedEvents($limit, $offset);

//            $this->deleteFailedEvents(...$failedEvents);
//
//            $this->eventBus->dispatch(...$failedEvents);

            $offset += $limit;

            $totalFailedEventsDispatched += count($failedEvents);
        }

        $this->info("Dispatching process finished: $totalFailedEventsDispatched events dispatched");
    }

    /**
     * @param int $limit
     * @param int $offset
     * @return array
     */
    private function searchFailedEvents(int $limit, int $offset): array
    {
        $filterOptions = [
            'limit' => $limit,
            'skip'  => $offset,
            'sort'  => ['fired_at' => 1],
        ];

        return $this->MongoDbDomainEventsCollection
            ->find(options: $filterOptions)
            ->toArray();
    }

    /**
     * @param Event ...$events
     * @return void
     */
    private function deleteFailedEvents(Event ...$events) : void
    {
        $eventIds = array_map(
            fn(Event $event) => (string) $event->getEventId(),
            $events
        );

        $this->MongoDbDomainEventsCollection->deleteMany([
            'event_id' => $eventIds,
        ]);
    }
}
