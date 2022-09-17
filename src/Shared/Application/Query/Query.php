<?php

namespace ReportsApp\Shared\Application\Query;

use ReportsApp\Shared\Domain\Bus\Query\Query as QueryContract;
use Spatie\DataTransferObject\DataTransferObject;

/**
 * Class Query
 *
 * @package ReportsApp\Shared\Application\Query
 */
abstract class Query extends DataTransferObject implements QueryContract
{

}
