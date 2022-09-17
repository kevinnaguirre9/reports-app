<?php

namespace ReportsApp\Shared\Infrastructure\Persistence\Doctrine;

use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ODM\MongoDB\MongoDBException;
use Doctrine\ODM\MongoDB\Repository\DocumentRepository;
use ReportsApp\Shared\Domain\BaseEntity;

/**
 * Class DoctrineRepository
 *
 * @package ReportsApp\Shared\Infrastructure\Persistence\Doctrine
 */
abstract class DoctrineRepository
{
    /**
     * @param DocumentManager $documentManager
     */
    public function __construct(public DocumentManager $documentManager)
    {
    }

    /**
     * @return DocumentManager
     */
    protected function documentManager(): DocumentManager
    {
        return $this->documentManager;
    }

    /**
     * @param BaseEntity $Entity
     * @return void
     * @throws MongoDBException
     */
    protected function persist(BaseEntity $Entity) : void
    {
        $this->documentManager()->persist($Entity);
        $this->documentManager()->flush();
    }

    /**
     * @param BaseEntity $Entity
     * @return void
     * @throws MongoDBException
     */
    protected function remove(BaseEntity $Entity) : void
    {
        $this->documentManager()->remove($Entity);
        $this->documentManager()->flush();
    }

    /**
     * @param $entityClass
     * @return DocumentRepository
     */
    protected function repository($entityClass) : DocumentRepository
    {
        return $this->documentManager()->getRepository($entityClass);
    }
}
