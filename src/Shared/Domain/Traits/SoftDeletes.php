<?php

namespace ReportsApp\Shared\Domain\Traits;

/**
 * Trait SoftDeletes
 *
 * @package CustomerManagement\Shared\Domain\Traits
 */
trait SoftDeletes
{
    /**
     * @var string
     */
    private string $deletedAt;
}
