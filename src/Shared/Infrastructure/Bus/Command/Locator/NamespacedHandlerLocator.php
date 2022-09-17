<?php

namespace ReportsApp\Shared\Infrastructure\Bus\Command\Locator;

use League\Tactician\Exception\MissingHandlerException;
use League\Tactician\Handler\Locator\HandlerLocator;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;
use ReportsApp\Shared\Domain\Bus\Command\CommandHandler;

/**
 * Class NamespacedHandlerLocator
 *
 * @package ReportsApp\Shared\Infrastructure\Bus\Command\Locator
 */
final class NamespacedHandlerLocator implements HandlerLocator
{
    /**
     * @param ContainerInterface $container
     */
    public function __construct(private ContainerInterface $container)
    {
    }

    /**
     * Retrieves the handler for a specified command
     *
     * @param $commandName
     *
     * @return CommandHandler
     *
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function getHandlerForCommand($commandName): CommandHandler
    {
        $commandHandler = $this->resolveHandlerForCommand($commandName);

        return $this->container->get($commandHandler);
    }

    /**
     * Resolve a Handler FQCN from a command FQCN.
     *
     * @param $commandName
     * @return string
     */
    private function resolveHandlerForCommand($commandName) : string
    {
        $handler = "{$commandName}Handler";

        if(!class_exists($handler))
            throw MissingHandlerException::forCommand($commandName);

        return $handler;
    }
}
