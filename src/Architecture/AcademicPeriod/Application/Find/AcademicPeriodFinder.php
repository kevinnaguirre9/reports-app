<?php

namespace ReportsApp\Architecture\AcademicPeriod\Application\Find;

use ReportsApp\Architecture\AcademicPeriod\Domain\AcademicPeriod;
use ReportsApp\Architecture\AcademicPeriod\Domain\AcademicPeriodRepository;
use ReportsApp\Architecture\AcademicPeriod\Domain\Exceptions\AcademicPeriodNotFound;
use ReportsApp\Architecture\AcademicPeriod\Domain\ValueObjects\AcademicPeriodId;
use ReportsApp\Shared\Domain\Exceptions\InvalidUuid;

/**
 * Class AcademicPeriodFinder
 *
 * @package ReportsApp\Architecture\AcademicPeriod\Application\Find
 */
final class AcademicPeriodFinder
{
    /**
     * @param AcademicPeriodRepository $repository
     */
    public function __construct(private AcademicPeriodRepository $repository)
    {
    }

    /**
     * @param FindAcademicPeriodQuery $query
     * @return AcademicPeriod
     * @throws AcademicPeriodNotFound
     * @throws InvalidUuid
     */
    public function __invoke(FindAcademicPeriodQuery $query): AcademicPeriod
    {
        $AcademicPeriod = $this->repository->find(new AcademicPeriodId($query->id));

        $this->ensureAcademicPeriodExists($AcademicPeriod);

        return $AcademicPeriod;
    }

    /**
     * @param AcademicPeriod|null $AcademicPeriod
     * @return void
     * @throws AcademicPeriodNotFound
     */
    private function ensureAcademicPeriodExists(?AcademicPeriod $AcademicPeriod): void
    {
        if (null === $AcademicPeriod)
            throw new AcademicPeriodNotFound('Academic Period not found');
    }
}
