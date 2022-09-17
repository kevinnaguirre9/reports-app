<?php

namespace ReportsApp\Shared\Domain\ValueObject;

use ReportsApp\Shared\Domain\Exceptions\InvalidUuid;
use Ramsey\Uuid\Uuid;
use Stringable;

/**
 * Class RamseyUuid
 *
 * @package ReportsApp\Shared\Domain\ValueObject
 */
class RamseyUuid implements Stringable
{
    /**
     * @param string|null $value
     * @throws InvalidUuid
     */
    public function __construct(public ?string $value = null)
    {
        $this->value = $this->value
            ? $this->ensureIsValidUuid($this->value)
            : self::generateUuid4();
    }

    /**
     * @return string
     */
    public function value(): string
    {
        return $this->value;
    }

    /**
     * @return string
     */
    private static function generateUuid4(): string
    {
        return Uuid::uuid4()->toString();
    }

    /**
     * @throws InvalidUuid
     */
    private function ensureIsValidUuid(string $uuid): string
    {
        if (!Uuid::isValid($uuid))
            throw new InvalidUuid(sprintf('Invalid uuid <%s>.', $uuid));

        return $uuid;
    }

    /**
     * @param RamseyUuid $other
     * @return bool
     */
    public function equals(RamseyUuid $other): bool
    {
        return $this->value() === $other->value();
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->value();
    }
}
