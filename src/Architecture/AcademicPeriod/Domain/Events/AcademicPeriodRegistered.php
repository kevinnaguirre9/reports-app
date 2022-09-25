<?php

namespace ReportsApp\Architecture\AcademicPeriod\Domain\Events;


/**
 * Class AcademicPeriodRegistered
 *
 * @package ReportsApp\Architecture\AcademicPeriod\Domain\Events
 */
final class AcademicPeriodRegistered extends AcademicPeriodEvent
{
    /**
     * @var string
     */
    public const NAME = 'academic_period_registered';

}
