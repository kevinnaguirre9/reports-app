<?php

namespace ReportsApp\Architecture\DataSource\Application\Create;

use ReportsApp\Architecture\AcademicPeriod\Domain\Exceptions\AcademicPeriodNotFound;
use ReportsApp\Architecture\DataSource\Domain\Exceptions\InvalidDataSourceType;
use ReportsApp\Shared\Domain\Bus\Command\CommandHandler;
use ReportsApp\Shared\Domain\Exceptions\InvalidUuid;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

/**
 * Class CreateDataSourceCommandHandler
 *
 * @package ReportsApp\Architecture\DataSource\Application\Create
 */
final class CreateDataSourceCommandHandler implements CommandHandler
{
    /**
     * @param DataSourceCreator $creator
     */
    public function __construct(private DataSourceCreator $creator)
    {
    }

    /**
     * @param CreateDataSourceCommand $command
     * @return void
     * @throws AcademicPeriodNotFound
     * @throws InvalidDataSourceType
     * @throws InvalidUuid
     * @throws UnknownProperties
     */
    public function __invoke(CreateDataSourceCommand $command) : void
    {
        ($this->creator)($command);
    }
}
