<?php

namespace ReportsApp\Architecture\DataSource\Domain;

use ReportsApp\Architecture\AcademicPeriod\Domain\AcademicPeriod;
use ReportsApp\Architecture\DataSource\Domain\ValueObjects\DataSourceId;
use ReportsApp\Architecture\DataSource\Domain\ValueObjects\DataSourceType;
use ReportsApp\Shared\Domain\AggregateRoot;
use ReportsApp\Shared\Domain\Traits\SoftDeletes;

/**
 * Class DataSource
 *
 * @package ReportsApp\Architecture\DataSource\Domain
 */
class DataSource extends AggregateRoot
{
    use SoftDeletes;

    /**
     * @param DataSourceId $id
     * @param string $name
     * @param DataSourceType $type
     * @param AcademicPeriod $AcademicPeriod
     * @param string|null $description
     */
    public function __construct(
        protected DataSourceId $id,
        protected string $name,
        protected DataSourceType $type,
        protected AcademicPeriod $AcademicPeriod,
        protected ?string $description,
    )
    {
        parent::__construct();
    }

    /**
     * @param DataSourceId $id
     * @param string $name
     * @param DataSourceType $type
     * @param AcademicPeriod $AcademicPeriod
     * @param string|null $description
     * @return static
     */
    public static function create(
        DataSourceId $id,
        string $name,
        DataSourceType $type,
        AcademicPeriod $AcademicPeriod,
        ?string $description,
    ): self
    {
        return new self($id, $name, $type, $AcademicPeriod, $description);
    }

    /**
     * @return DataSourceId
     */
    public function getId(): DataSourceId
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
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return DataSourceType
     */
    public function getType(): DataSourceType
    {
        return $this->type;
    }

    /**
     * @return AcademicPeriod
     */
    public function getAcademicPeriod(): AcademicPeriod
    {
        return $this->AcademicPeriod;
    }
}
