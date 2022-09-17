<?php

namespace ReportsApp\Architecture\DataSource\Infrastructure\Persistence;

use Doctrine\ODM\MongoDB\LockException;
use Doctrine\ODM\MongoDB\Mapping\MappingException;
use Doctrine\ODM\MongoDB\MongoDBException;
use ReportsApp\Architecture\DataSource\Domain\DataSource;
use ReportsApp\Architecture\DataSource\Domain\DataSourceRepository;
use ReportsApp\Architecture\DataSource\Domain\ValueObjects\DataSourceId;
use ReportsApp\Shared\Infrastructure\Persistence\Doctrine\DoctrineRepository;

/**
 * Class MongoDbDataSourceRepository
 *
 * @package ReportsApp\Architecture\DataSource\Infrastructure\Persistence
 */
final class MongoDbDataSourceRepository extends DoctrineRepository implements DataSourceRepository
{
    /**
     * @param DataSource $dataSource
     * @return void
     * @throws MongoDBException
     */
    public function save(DataSource $dataSource): void
    {
        $this->persist($dataSource);
    }

    /**
     * @param DataSourceId $id
     * @return DataSource|null
     * @throws LockException
     * @throws MappingException
     */
    public function find(DataSourceId $id): ?DataSource
    {
        return $this
            ->repository(DataSource::class)
            ->find($id);
    }

    /**
     * @return array
     */
    public function searchAll(): array
    {
        return $this
            ->repository(DataSource::class)
            ->findAll();
    }
}
