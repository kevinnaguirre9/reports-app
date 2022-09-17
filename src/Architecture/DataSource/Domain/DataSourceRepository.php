<?php

namespace ReportsApp\Architecture\DataSource\Domain;

use ReportsApp\Architecture\DataSource\Domain\ValueObjects\DataSourceId;

/**
 * Interface DataSourceRepository
 *
 * @package ReportsApp\Architecture\DataSource\Domain
 */
interface DataSourceRepository
{
    /**
     * @param DataSource $dataSource
     * @return void
     */
    public function save(DataSource $dataSource) : void;

    /**
     * @param DataSourceId $id
     * @return DataSource|null
     */
    public function find(DataSourceId $id) : ?DataSource;

    /**
     * @return array
     */
    public function searchAll() : array;
}
