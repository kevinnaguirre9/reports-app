<?php

namespace App\Providers;

use Enqueue\SimpleClient\SimpleClient;
use ReportsApp\Shared\Domain\Bus\Event\EventBus;
use ReportsApp\Shared\Infrastructure\Bus\Event\RabbitMq\Processor\EventTypeDelegateProcessor;
use ReportsApp\Shared\Infrastructure\Bus\Event\RabbitMq\Processor\EventTypeDelegateProcessorFactory;
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
     * The Processor list to be registered.
     *
     * A specific processor must be defined for each type of event we'd like to process.
     *
     * @var array
     */
    protected static array $processors = [
        'events' => [
            'domain.reports-app.academic_period_registered' => \App\Queue\Processors\NullProcessor::class
        ],
    ];


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

        $this->app->bind(
            EventTypeDelegateProcessor::class,
            fn ($app) => (new EventTypeDelegateProcessorFactory($app))(self::$processors['events'])
        );
    }
}
