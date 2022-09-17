<?php

namespace ReportsApp\Shared\Infrastructure\Bus\Event\RabbitMq;

use ReportsApp\Shared\Domain\Bus\Event\DomainEvent;
use ReportsApp\Shared\Domain\Bus\Event\EventBus;
use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

/**
 * Class RabbitMqEventBus
 *
 * @package ReportsApp\Shared\Infrastructure\Bus\Event\RabbitMq
 */
final class RabbitMqEventBus implements EventBus
{
    /**
     * @var AMQPChannel|mixed
     */
    private AMQPChannel $channel;

    /**
     * @param AMQPStreamConnection $connection
     * @param string $exchange
     */
    public function __construct(
        private AMQPStreamConnection $connection,
        private string $exchange,
    )
    {
        $this->channel = $this->connection->channel();

        $this->declareExchange();
    }

    /**
     * @param DomainEvent $event
     * @return void
     */
    public function publish(DomainEvent $event): void
    {
        $routingKey = $event->getType();

        $messageBody = new AMQPMessage(
            json_encode($event->jsonSerialize()),
            [
                'message_id'       => (string) $event->getEventId(),
                'content_type'     => 'application/json',
                'content_encoding' => 'utf-8',
            ]
        );

        $this->channel->basic_publish(
            $messageBody,
            $this->exchange,
            $routingKey,
        );
    }

    /**
     * @return void
     */
    private function declareExchange(): void
    {
        $this->channel->exchange_declare(
            $this->exchange,
            config('enqueue.connections.rabbitmq.exchange.type'),
            durable: config('enqueue.connections.rabbitmq.exchange.durable'),
            auto_delete: config('enqueue.connections.rabbitmq.exchange.auto_delete'),
        );
    }
}
