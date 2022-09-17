<?php

namespace ReportsApp\Shared\Infrastructure\Doctrine\CustomTypes;

/**
 * Interface DoctrineCustomType
 *
 * @package CodelyTv\Shared\Infrastructure\Doctrine\CustomTypes
 */
interface DoctrineCustomType
{
    /**
     * @return string
     */
    public static function customTypeName(): string;
}
