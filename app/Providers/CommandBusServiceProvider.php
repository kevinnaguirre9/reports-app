<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use ReportsApp\Shared\Domain\Bus\Command\CommandBus;
use ReportsApp\Shared\Infrastructure\Bus\Command\CommandBusFactory;
use ReportsApp\Shared\Infrastructure\Bus\Command\SyncCommandBus;

/**
 * Class CommandBusServiceProvider
 *
 * @package App\Providers
 */
final class CommandBusServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'League\Tactician\CommandBus', function ($app) {
                return (new CommandBusFactory)($app);
            }
        );

        $this->app->bind(CommandBus::class, SyncCommandBus::class);
    }
}
