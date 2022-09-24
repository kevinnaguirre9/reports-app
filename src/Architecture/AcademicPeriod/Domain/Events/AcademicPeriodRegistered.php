<?php

namespace ReportsApp\Architecture\AcademicPeriod\Domain\Events;

use ReportsApp\Architecture\AcademicPeriod\Domain\AcademicPeriod;
use ReportsApp\Shared\Domain\Bus\Event\DomainEvent;

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
