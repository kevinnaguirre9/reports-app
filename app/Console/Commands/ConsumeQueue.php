<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Psr\Log\LoggerInterface;
use ReportsApp\Shared\Infrastructure\Bus\Event\RabbitMq\RabbitMqDomainEventsConsumer;

/**
 * Class ConsumeQueue
 *
 * @package App\Console\Commands
 */
final class ConsumeQueue extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'queue:consume';

    /**
     * The console command description.
     */
    protected $description = 'Starts the rabbitmq queue consume';

    /**
     * @param RabbitMqDomainEventsConsumer $domainEventsConsumer
     * @param LoggerInterface $logger
     */
    public function __construct(
        private RabbitMqDomainEventsConsumer $domainEventsConsumer,
        private LoggerInterface $logger,
    )
    {
        parent::__construct();
    }

    /**
     * @return void
     * @throws \Exception
     */
    public function handle() : void
    {
        $this->logger->notice(sprintf(
            'Starting to consume the %s RabbitMQ queue ...',
            env('APP_NAME')
        ));

        $this->domainEventsConsumer->consume();
    }
}
