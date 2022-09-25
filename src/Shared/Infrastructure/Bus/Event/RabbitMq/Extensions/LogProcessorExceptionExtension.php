<?php

namespace ReportsApp\Shared\Infrastructure\Bus\Event\RabbitMq\Extensions;

use Enqueue\Consumption\Context\ProcessorException;
use Enqueue\Consumption\ProcessorExceptionExtensionInterface;
use Enqueue\Consumption\Result;
use Psr\Log\LoggerInterface;

/**
 * Class LogProcessorExceptionExtension
 *
 * @package ReportsApp\Shared\Infrastructure\Bus\Event\RabbitMq\Extensions
 */
final class LogProcessorExceptionExtension implements ProcessorExceptionExtensionInterface
{
    /**
     * @param LoggerInterface $logger
     */
    public function __construct(private LoggerInterface $logger)
    {
    }

    public function onProcessorException(ProcessorException $context): void
    {
        $exceptionMessage = $context->getException()->getMessage();

        $this->logger->debug(sprintf(
            "Message rejected by configured processor due to the following exception: %s",
            $exceptionMessage
        ));

        //Set result as rejected
        $context->setResult(Result::reject($exceptionMessage));
    }
}
