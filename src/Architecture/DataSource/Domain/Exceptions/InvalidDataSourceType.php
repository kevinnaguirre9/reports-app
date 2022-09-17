<?php

namespace ReportsApp\Architecture\DataSource\Domain\Exceptions;

/**
 * Class InvalidDataSourceType
 *
 * @package ReportsApp\Architecture\DataSource\Domain\Exceptions
 */
final class InvalidDataSourceType extends \Exception
{
    /**
     * @param string $dataSourceType
     */
    public function __construct(string $dataSourceType)
    {
        parent::__construct(sprintf("'%s' is not a valid data source type", $dataSourceType));
    }
}
