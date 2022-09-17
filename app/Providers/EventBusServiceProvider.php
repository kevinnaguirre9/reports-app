<?php

namespace App\Providers;

use ReportsApp\Shared\Domain\Bus\Event\EventBus;
use ReportsApp\Shared\Infrastructure\Bus\Event\RabbitMq\RabbitMqEventBus;
use Illuminate\Support\ServiceProvider;
use PhpAmqpLib\Connection\AMQPStreamConnection;

/**
 * Class EventBusServiceProvider
 *
 * @package App\Providers
 */
final class EventBusServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(EventBus::class, function () {
            return new RabbitMqEventBus(
                new AMQPStreamConnection(
                    config('enqueue.connections.rabbitmq.host'),
                    config('enqueue.connections.rabbitmq.port'),
                    config('enqueue.connections.rabbitmq.user'),
                    config('enqueue.connections.rabbitmq.password'),
                    config('enqueue.connections.rabbitmq.vhost')
                ),
                config('enqueue.connections.rabbitmq.exchange.name'),
            );
        });
    }
}
{

}
