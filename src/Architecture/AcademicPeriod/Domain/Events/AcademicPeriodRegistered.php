<?php

namespace ReportsApp\Architecture\AcademicPeriod\Domain\Events;

use ReportsApp\Architecture\AcademicPeriod\Domain\AcademicPeriod;
use ReportsApp\Shared\Domain\Bus\Event\DomainEvent;

/**
 * Class AcademicPeriodRegistered
 *
 * @package ReportsApp\Architecture\AcademicPeriod\Domain\Events
 */
final class AcademicPeriodRegistered extends DomainEvent
{
    /**
     * @var string
     */
    public const NAME = 'tech-org.academic-period.1.event.academic-period.registered';

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
        return $this->AcademicPeriod->toArray();
    }
}
