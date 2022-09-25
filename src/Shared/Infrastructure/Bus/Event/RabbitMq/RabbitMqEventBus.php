<?php

namespace ReportsApp\Shared\Infrastructure\Bus\Event\RabbitMq;

use Enqueue\Client\Message;
use Enqueue\SimpleClient\SimpleClient;
use Psr\Log\LoggerInterface;
use ReportsApp\Shared\Domain\Bus\Event\Event;
use ReportsApp\Shared\Domain\Bus\Event\EventBus;
use ReportsApp\Shared\Infrastructure\Bus\Event\MongoDb\MongoDbEventBus;

/**
 * Class RabbitMqEventBus
 *
 * @package ReportsApp\Shared\Infrastructure\Bus\Event\RabbitMq
 */
final class RabbitMqEventBus implements EventBus
{
    /**
     * @param SimpleClient $client
     * @param MongoDbEventBus $failOverPublisher
     * @param LoggerInterface $logger
     */
    public function __construct(
        private SimpleClient $client,
        private MongoDbEventBus $failOverPublisher,
        private LoggerInterface $logger,
    )
    {
    }

    /**
     * @param Event ...$events
     * @return void
     */
    public function dispatch(Event ...$events): void
    {
        foreach ($events as $event) {

            try {

                $this->publishEvent($event);

            } catch (\Exception $exception) {

                $this->logger->error($exception->getMessage());

                $this->failOverPublisher->dispatch($event);
            }
        }
    }

    /**
     * Publishes an event to the message broker
     *
     * @param Event $event
     * @return void
     */
    private function publishEvent(Event $event)
    {
        $message = new Message($event);

        $message->setHeader('message_id ', (string) $event->getEventId());

        $message->setHeader('type', env('APP_NAME') . ".{$event->getType()}");

        $message->setHeader('app_id', env('APP_NAME'));

        $topic = $this->client
            ->getDriver()
            ->getConfig()
            ->getRouterTopic();

        $this->client->sendEvent($topic, $message);
    }
}
