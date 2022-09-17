<?php

namespace ReportsApp\Architecture\DataSource\Domain\ValueObjects;

use ReportsApp\Architecture\DataSource\Domain\Exceptions\InvalidDataSourceType;
use ReportsApp\Shared\Domain\ValueObject\StringValueObject;

/**
 * Class DataSourceType
 *
 * @package ReportsApp\Architecture\DataSource\Domain\ValueObjects
 */
final class DataSourceType extends StringValueObject
{
    private const BIBLE = 'BIBLE';

    private const REPORT = 'REPORT';

    private const INDICATOR = 'INDICATOR';

    /**
     * @param string $value
     * @throws InvalidDataSourceType
     */
    public function __construct(string $value)
    {
        $this->ensureIsValidDataSourceType($value);
        parent::__construct($value);
    }

    /**
     * @param string $value
     * @return void
     * @throws InvalidDataSourceType
     */
    private function ensureIsValidDataSourceType(string $value)
    {
        if (!in_array($value, [self::BIBLE, self::REPORT, self::INDICATOR]))
            throw new InvalidDataSourceType($value);
    }
}
