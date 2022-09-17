<?php

namespace ReportsApp\Shared\Infrastructure\Persistence\Doctrine;

use Doctrine\ODM\MongoDB\Types\ClosureToPHP;
use Doctrine\ODM\MongoDB\Types\Type;
use ReportsApp\Shared\Infrastructure\Doctrine\CustomTypes\DoctrineCustomType;

/**
 * Class UuidTypeShared
 *
 * @package ReportsApp\Shared\Infrastructure\Persistence\Doctrine
 */
abstract class UuidTypeShared extends Type implements DoctrineCustomType
{
    use ClosureToPHP;

    /**
     * @return string
     */
    abstract public function customTypeClassName() : string;

    /**
     * @param $value
     * @return mixed
     */
    public function convertToPHPValue($value): mixed
    {
        $classname = $this->customTypeClassName();

        return new $classname($value);
    }

    /**
     * @param $value
     * @return mixed|string
     */
    public function convertToDatabaseValue($value): mixed
    {
        $classname = $this->customTypeClassName();

        return $value instanceof $classname ? $value->value() : $value;
    }
}
