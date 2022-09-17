<?php

namespace ReportsApp\Architecture\AcademicPeriod\Infrastructure\Persistence;

use Doctrine\ODM\MongoDB\{LockException, Mapping\MappingException, MongoDBException};
use ReportsApp\Architecture\AcademicPeriod\Domain\{AcademicPeriod,
    AcademicPeriodRepository,
    ValueObjects\AcademicPeriodId};
use ReportsApp\Shared\Infrastructure\Persistence\Doctrine\DoctrineRepository;

/**
 * Class DoctrineAcademicPeriodRepository
 *
 * @package ReportsApp\Architecture\AcademicPeriod\Infrastructure\Persistence
 */
final class MongoDbAcademicPeriodRepository extends DoctrineRepository implements AcademicPeriodRepository
{
    /**
     * @param AcademicPeriod $AcademicPeriod
     * @return void
     * @throws MongoDBException
     */
    public function save(AcademicPeriod $AcademicPeriod): void
    {
        $this->persist($AcademicPeriod);
    }

    /**
     * @param \ReportsApp\Architecture\AcademicPeriod\Domain\ValueObjects\AcademicPeriodId $id
     * @return AcademicPeriod|null
     * @throws LockException
     * @throws MappingException
     */
    public function find(AcademicPeriodId $id): ?AcademicPeriod
    {
        return $this
            ->repository(AcademicPeriod::class)
            ->find($id);
    }

    /**
     * @return array
     */
    public function searchAll(): array
    {
        return $this
            ->repository(AcademicPeriod::class)
            ->findAll();
    }
}
