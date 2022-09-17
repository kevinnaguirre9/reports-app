<?php

namespace ReportsApp\Architecture\DataSource\Infrastructure\Persistence\Doctrine;

use ReportsApp\Architecture\DataSource\Domain\ValueObjects\DataSourceType;
use ReportsApp\Shared\Infrastructure\Persistence\Doctrine\StringTypeShared;

/**
 * Class DataSourceTypeType
 *
 * @package ReportsApp\Architecture\DataSource\Infrastructure\Persistence\Doctrine
 */
final class DataSourceTypeType extends StringTypeShared
{
    /**
     * @return string
     */
    public function customTypeClassName(): string
    {
        return DataSourceType::class;
    }

    /**
     * @return string
     */
    public static function customTypeName(): string
    {
        return 'data_source_type';
    }
}
