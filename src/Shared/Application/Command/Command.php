<?php

namespace ReportsApp\Shared\Application\Command;

use ReportsApp\Shared\Domain\Bus\Command\Command as CommandContract;
use Spatie\DataTransferObject\DataTransferObject;

/**
 * Class Command
 *
 * @package ReportsApp\Shared\Application\Command
 */
abstract class Command extends DataTransferObject implements CommandContract
{

}
