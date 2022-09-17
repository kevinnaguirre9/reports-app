<?php

namespace ReportsApp\Architecture\AcademicPeriod\Infrastructure\Persistence\Doctrine;

use ReportsApp\Architecture\AcademicPeriod\Domain\ValueObjects\AcademicPeriodId;
use ReportsApp\Shared\Infrastructure\Persistence\Doctrine\UuidTypeShared;

/**
 * Class AcademicPeriodIdType
 *
 * @package ReportsApp\Architecture\AcademicPeriod\Infrustructure\Persistence\Doctrine
 */
final class AcademicPeriodIdType extends UuidTypeShared
{
    /**
     * @return string
     */
    public function customTypeClassName() : string
    {
        return AcademicPeriodId::class;
    }

    /**
     * @return string
     */
    public static function customTypeName() : string
    {
        return 'academic_period_id';
    }

}
