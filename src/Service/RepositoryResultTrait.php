<?php

namespace App\Service;

use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;

/**
 * Trait RepositoryResultTrait
 */
trait RepositoryResultTrait
{
    /**
     * @var bool
     */
    protected $returnQuery = false;
    /**
     * @var int
     */
    protected $queryHydration = Query::HYDRATE_OBJECT;

    /**
     * @param bool $shouldReturnQuery
     *
     * @return self
     */
    public function setReturnQuery(bool $shouldReturnQuery): self
    {
        $this->returnQuery = $shouldReturnQuery;

        return $this;
    }

    /**
     * @return bool
     */
    public function shouldReturnQuery(): bool
    {
        return $this->returnQuery;
    }

    /**
     * @param QueryBuilder $qb
     * @param int|null     $hydration
     *
     * @return QueryBuilder|mixed
     */
    public function getResult(QueryBuilder $qb, int $hydration = null)
    {
        $hydration = $hydration ?? $this->queryHydration;
        $result = $this->returnQuery ? $qb : $qb->getQuery()->getResult($hydration);

        $this->setReturnQuery(false);

        return $result;
    }

    /**
     * @param int $queryHydration
     *
     * @return self
     */
    public function setQueryHydration(int $queryHydration): self
    {
        $this->queryHydration = $queryHydration;

        return $this;
    }
}
