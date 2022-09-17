<?php

namespace ReportsApp\Architecture\AcademicPeriod\Domain;

use ReportsApp\Architecture\AcademicPeriod\Domain\ValueObjects\AcademicPeriodId;

/**
 * Interface AcademicPeriodRepository
 *
 * @package ReportsApp\Architecture\AcademicPeriod\Domain
 */
interface AcademicPeriodRepository
{
    /**
     * @param AcademicPeriod $AcademicPeriod
     * @return void
     */
    public function save(AcademicPeriod $AcademicPeriod): void;

    /**
     * @param AcademicPeriodId $id
     * @return AcademicPeriod|null
     */
    public function find(AcademicPeriodId $id): ?AcademicPeriod;

    /**
     * @return array
     */
    public function searchAll(): array;
}
