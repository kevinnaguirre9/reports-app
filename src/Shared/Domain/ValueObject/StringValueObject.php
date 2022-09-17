<?php

declare(strict_types=1);

namespace ReportsApp\Shared\Domain\ValueObject;

/**
 * Class StringValueObject
 *
 * @package ReportsApp\Shared\Domain\ValueObject
 */
abstract class StringValueObject
{
    /**
     * @param string $value
     */
    public function __construct(public string $value)
    {
    }

    /**
     * @return string
     */
    public function value(): string
    {
        return $this->value;
    }

}
