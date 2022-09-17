<?php

namespace ReportsApp\Architecture\AcademicPeriod\Domain;

use ReportsApp\Architecture\AcademicPeriod\Domain\ValueObjects\AcademicPeriodId;
use ReportsApp\Shared\Domain\AggregateRoot;
use ReportsApp\Shared\Domain\Traits\SoftDeletes;

/**
 * Class AcademicPeriod
 *
 * @package ReportsApp\Architecture\AcademicPeriod\Domain
 */
class AcademicPeriod extends AggregateRoot
{
    use SoftDeletes;

    /**
     * @param AcademicPeriodId $id
     * @param string $name
     * @param string $startDate
     * @param string $endDate
     * @param string|null $description
     */
    public function __construct(
        protected AcademicPeriodId $id,
        protected string $name,
        protected string $startDate,
        protected string $endDate,
        protected ?string $description,
    )
    {
        parent::__construct();
    }

    /**
     * @param AcademicPeriodId $id
     * @param string $name
     * @param string $startDate
     * @param string $endDate
     * @param string|null $description
     * @return AcademicPeriod
     */
    public static function create(
        AcademicPeriodId $id,
        string $name,
        string $startDate,
        string $endDate,
        ?string $description = null,
    ): AcademicPeriod
    {
        return new self($id, $name, $startDate, $endDate, $description);
    }

    /**
     * @return AcademicPeriodId
     */
    public function getId(): AcademicPeriodId
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getStartDate(): string
    {
        return $this->startDate;
    }

    /**
     * @return string
     */
    public function getEndDate(): string
    {
        return $this->endDate;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @return void
     */
    public function delete(): void
    {
        $this->deletedAt = date('Y-m-d H:i:s');
    }
}
