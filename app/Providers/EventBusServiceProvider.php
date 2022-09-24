<?php

namespace App\Providers;

use Enqueue\SimpleClient\SimpleClient;
use ReportsApp\Shared\Domain\Bus\Event\EventBus;
use ReportsApp\Shared\Infrastructure\Bus\Event\RabbitMq\RabbitMqEventBus;
use Illuminate\Support\ServiceProvider;

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
        $this->app->bind(SimpleClient::class, function ($app) {
            return new SimpleClient(config('enqueue.client'));
        });

        $this->app->resolving(SimpleClient::class,
            function (SimpleClient $client, $app) {
                $client->setupBroker();
                return $client;
            }
        );

        $this->app->bind(EventBus::class, RabbitMqEventBus::class);
    }
}
