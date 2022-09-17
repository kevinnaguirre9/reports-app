<?php

namespace ReportsApp\Architecture\AcademicPeriod\Application\SearchAll;

use ReportsApp\Architecture\AcademicPeriod\Domain\AcademicPeriodRepository;

/**
 * Class AllAcademicPeriodsSearcher
 *
 * @package ReportsApp\Architecture\AcademicPeriod\Application\SearchAll
 */
final class AllAcademicPeriodsSearcher
{
    /**
     * @param AcademicPeriodRepository $repository
     */
    public function __construct(private AcademicPeriodRepository $repository)
    {
    }

    /**
     * @param SearchAllAcademicPeriodsQuery $query
     * @return array
     */
    public function __invoke(SearchAllAcademicPeriodsQuery $query): array
    {
        return $this->repository->searchAll();
    }
}
