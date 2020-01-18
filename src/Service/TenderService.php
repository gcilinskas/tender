<?php

namespace App\Service;

use App\Entity\Tender;
use App\Repository\TenderRepository;
use DateTime;
use Doctrine\ORM\QueryBuilder;

/**
 * Class TenderService
 */
class TenderService extends BaseService
{
    use RepositoryResultTrait;

    /** @var TenderRepository */
    protected $repository;

    /**
     * get all entities
     *
     * @return array
     */
    public function getAll()
    {
        return $this->repository->findAll();
    }

    /**
     * @return string
     */
    public function getEntityClass(): string
    {
        return Tender::class;
    }

    /**
     * @param Tender $tender
     * @param bool $flush
     *
     * @throws \Exception
     */
    public function updateEntity(Tender $tender, $flush = true)
    {
        $tender->setUpdatedAt(new DateTime());
        $this->update($tender, $flush);
    }

    /**
     * remove tender
     *
     * @param Tender $entity
     * @param bool $flush
     *
     * @throws \Exception
     */
    public function delete($entity, bool $flush = true): void
    {
        $this->remove($entity, $flush);
    }

    /**
     * @return QueryBuilder
     */
    public function getQueryBuilder(): QueryBuilder
    {
        return $this->repository->createQueryBuilder('t');
    }
}
