<?php

namespace ReportsApp\Shared\Infrastructure\Doctrine\CustomTypes;

use Doctrine\ODM\MongoDB\Types\Type;

/**
 * Class CustomTypeRegistrar
 *
 * @package ReportsApp\Shared\Infrastructure\Doctrine\CustomTypes
 */
class CustomTypeRegistrar
{
    /**
     * @var bool
     */
    private static bool $initialized = false;

    /**
     * @param array $customTypeClassNames
     * @return void
     */
    public static function register(array $customTypeClassNames): void
    {
        if (!self::$initialized) {

            array_walk($customTypeClassNames, self::registerType());

            self::$initialized = true;
        }
    }

    /**
     * @return callable
     */
    private static function registerType(): callable
    {
        return static function (string $customTypeClassName): void {
            Type::registerType($customTypeClassName::customTypeName(), $customTypeClassName);
        };
    }
}
