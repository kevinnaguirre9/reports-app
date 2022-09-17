<?php

declare(strict_types=1);

namespace ReportsApp\Shared\Domain\ValueObject;

/**
 * Class IntValueObject
 *
 * @package ReportsApp\Shared\Domain\ValueObject
 */
abstract class IntValueObject
{
    /**
     * @param int $value
     */
    public function __construct(public int $value)
    {
    }

    /**
     * @return int
     */
    public function value(): int
    {
        return $this->value;
    }

}
