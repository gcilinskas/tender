<?php

namespace App\Response;

use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Class QueryBuilderPaginator
 * @package App\Response
 */
class QueryBuilderPaginator implements ResponseData
{
    /** @var QueryBuilder */
    protected $queryBuilder;

    /** @var bool */
    protected $useOutputWalker = true;

    /** @var int */
    protected $itemsPerPage = 20;

    /** @var RequestStack */
    protected $requestStack;

    /** @var Request */
    protected $request;

    /**
     * QueryBuilderPaginator constructor.
     *
     * @param RequestStack       $requestStack
     */
    public function __construct(RequestStack $requestStack) {
        $this->requestStack = $requestStack;
    }

    /**
     * @param QueryBuilder $queryBuilder
     *
     * @return $this
     */
    public function setQueryBuilder(QueryBuilder $queryBuilder)
    {
        $this->queryBuilder = $queryBuilder;

        return $this;
    }

    /**
     * @return array
     */
    public function getResponseArray(): array
    {
        $response = [];

        $paginator = new Paginator($this->queryBuilder);
        $paginator->setUseOutputWalkers($this->useOutputWalker);

        $response['meta']['total-pages'] = ceil($paginator->count() / $this->getItemsPerPage());
        $response['meta']['show-in-page'] = $this->getItemsPerPage();

        $response['data'] = $paginator
            ->getQuery()
            ->setFirstResult($this->getItemsPerPage() * ($this->getCurrentPage() - 1))
            ->setMaxResults($this->getItemsPerPage())
            ->getResult();

        return $response;
    }

    /**
     * @return int
     */
    public function getItemsPerPage(): int
    {
        return $this->itemsPerPage;
    }

    /**
     * @param int $itemsPerPage
     *
     * @return $this
     */
    public function setItemsPerPage(int $itemsPerPage)
    {
        $this->itemsPerPage = $itemsPerPage;

        return $this;
    }

    /**
     * @return int
     */
    protected function getCurrentPage(): int
    {
        $request = $this->getRequest();
        if ($request->get('page')) {
            return intval($request->get('page'));
        }

        return 1;
    }

    /**
     * @return Request
     */
    public function getRequest(): ?Request
    {
        if (!$this->request) {
            $this->request = $this->requestStack->getMasterRequest();
        }

        return $this->request;
    }
}
