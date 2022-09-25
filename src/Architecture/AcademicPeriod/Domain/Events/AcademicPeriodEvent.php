<?php

namespace ReportsApp\Architecture\AcademicPeriod\Domain\Events;

use ReportsApp\Architecture\AcademicPeriod\Domain\AcademicPeriod;
use ReportsApp\Shared\Domain\Bus\Event\DomainEvent;

/**
 * Class AcademicPeriodEvent
 *
 * @package ReportsApp\Architecture\AcademicPeriod\Domain\Events
 */
abstract class AcademicPeriodEvent extends DomainEvent
{
    /**
     * @var string
     */
    public const NAME = 'academic_period_event';

    /**
     * @param AcademicPeriod $AcademicPeriod
     */
    public function __construct(private AcademicPeriod $AcademicPeriod)
    {
        parent::__construct();
    }

    /**
     * @return array
     */
    public function toArray() : array
    {
        return [
            'academic_period' => $this->AcademicPeriod->toArray(),
        ];
    }
}
