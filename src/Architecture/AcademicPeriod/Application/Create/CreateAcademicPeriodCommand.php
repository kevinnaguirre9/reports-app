<?php

namespace ReportsApp\Architecture\AcademicPeriod\Application\Create;

use ReportsApp\Shared\Application\Command\Command;

/**
 * Class CreateAcademicPeriodCommand
 *
 * @package ReportsApp\Architecture\AcademicPeriod\Application\Create
 */
final class CreateAcademicPeriodCommand extends Command
{
    /**
     * @var string
     */
    public string $name;

    /**
     * @var string|null
     */
    public ?string $description;

    /**
     * @var string
     */
    public string $startDate;

    /**
     * @var string
     */
    public string $endDate;
}
