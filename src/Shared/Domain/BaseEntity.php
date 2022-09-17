<?php

namespace ReportsApp\Shared\Domain;

use ReportsApp\Shared\Domain\Traits\IsSerializable;

/**
 * Class BaseEntity
 *
 * @package ReportsApp\Shared\Domain
 */
abstract class BaseEntity
{
    use IsSerializable;

    /**
     * @var string
     */
    protected string $createdAt;

    /**
     * @var string
     */
    protected string $updatedAt;

    /**
     *
     */
    public function __construct()
    {
        $this->createdAt = date('Y-m-d H:i:s');
        $this->updatedAt = date('Y-m-d H:i:s');
    }

    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    /**
     * @return string
     */
    public function getUpdatedAt(): string
    {
        return $this->updatedAt;
    }
}
