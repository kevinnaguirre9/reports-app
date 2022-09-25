<?php

namespace ReportsApp\Shared\Infrastructure\Bus\Command;

use League\Tactician\CommandBus;
use League\Tactician\Handler\CommandHandlerMiddleware;
use League\Tactician\Handler\CommandNameExtractor\ClassNameExtractor;
use League\Tactician\Handler\MethodNameInflector\InvokeInflector;
use League\Tactician\Plugins\LockingMiddleware;
use Psr\Container\ContainerInterface;
use ReportsApp\Shared\Infrastructure\Bus\Command\Locator\NamespacedHandlerLocator;

/**
 * Class CommandBusFactory
 *
 * @package ReportsApp\Shared\Infrastructure\Bus\Command
 */
final class CommandBusFactory
{
    /**
     * @param ContainerInterface $container
     * @return CommandBus
     */
    public function __invoke(ContainerInterface $container) : CommandBus
    {
        $handlerMiddleware = new CommandHandlerMiddleware(
            new ClassNameExtractor(),
            new NamespacedHandlerLocator($container),
            new InvokeInflector(),
        );

        return new CommandBus([
            new LockingMiddleware(),
            $handlerMiddleware,
        ]);
    }

}
