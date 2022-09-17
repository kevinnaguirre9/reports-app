<?php

namespace ReportsApp\Architecture\DataSource\Application\Create;

use ReportsApp\Architecture\AcademicPeriod\Application\Find\AcademicPeriodFinder;
use ReportsApp\Architecture\AcademicPeriod\Application\Find\FindAcademicPeriodQuery;
use ReportsApp\Architecture\AcademicPeriod\Domain\AcademicPeriod;
use ReportsApp\Architecture\AcademicPeriod\Domain\Exceptions\AcademicPeriodNotFound;
use ReportsApp\Architecture\DataSource\Domain\DataSource;
use ReportsApp\Architecture\DataSource\Domain\DataSourceRepository;
use ReportsApp\Architecture\DataSource\Domain\Exceptions\InvalidDataSourceType;
use ReportsApp\Architecture\DataSource\Domain\ValueObjects\DataSourceId;
use ReportsApp\Architecture\DataSource\Domain\ValueObjects\DataSourceType;
use ReportsApp\Shared\Domain\Exceptions\InvalidUuid;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

/**
 * Class DataSourceCreator
 *
 * @package ReportsApp\Architecture\DataSource\Application\Create
 */
final class DataSourceCreator
{
    /**
     * @param DataSourceRepository $repository
     * @param AcademicPeriodFinder $academicPeriodFinder
     */
    public function __construct(
        private DataSourceRepository $repository,
        private AcademicPeriodFinder $academicPeriodFinder,
    )
    {
    }

    /**
     * @param CreateDataSourceCommand $command
     * @return void
     * @throws AcademicPeriodNotFound
     * @throws InvalidUuid
     * @throws InvalidDataSourceType
     * @throws UnknownProperties
     */
    public function __invoke(CreateDataSourceCommand $command) : void
    {
        $AcademicPeriod = $this->getAcademicPeriod(
            new FindAcademicPeriodQuery(id: $command->academicPeriodId)
        );

        $DataSource = new DataSource(
            new DataSourceId(),
            $command->name,
            new DataSourceType($command->type),
            $AcademicPeriod,
            $command->description,
        );

        $this->repository->save($DataSource);
    }

    /**
     * @throws InvalidUuid
     * @throws AcademicPeriodNotFound
     */
    private function getAcademicPeriod(FindAcademicPeriodQuery $query) : AcademicPeriod
    {
        return ($this->academicPeriodFinder)($query);
    }
}
