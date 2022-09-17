<?php

namespace ReportsApp\Architecture\DataSource\Infrastructure\Persistence\Doctrine;

use ReportsApp\Architecture\DataSource\Domain\ValueObjects\DataSourceId;
use ReportsApp\Shared\Infrastructure\Persistence\Doctrine\UuidTypeShared;

/**
 * Class DataSourceIdType
 *
 * @package ReportsApp\Architecture\DataSource\Infrastructure\Persistence\Doctrine
 */
final class DataSourceIdType extends UuidTypeShared
{
    /**
     * @return string
     */
    public function customTypeClassName() : string
    {
        return DataSourceId::class;
    }

    /**
     * @return string
     */
    public static function customTypeName() : string
    {
        return 'data_source_id';
    }
}
