<?php

namespace ReportsApp\Architecture\DataSource\Application\Create;

use ReportsApp\Shared\Application\Command\Command;

/**
 * Class CreateDataSourceCommand
 *
 * @package ReportsApp\Architecture\DataSource\Application\Create
 */
final class CreateDataSourceCommand extends Command
{
    /**
     * @var string
     */
    public string $name;

    /**
     * @var string
     */
    public string $type;

    /**
     * @var string
     */
    public string $academicPeriodId;

    /**
     * @var string|null
     */
    public ?string $description;

}
