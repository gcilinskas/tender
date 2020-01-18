<?php

namespace App\Controller\Api;

use App\Form\Api\Tender\CreateType;
use App\Response\Entity;
use App\Response\QueryBuilderPaginator;
use App\Service\TenderService;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Tender;

/**
 * Class TenderController
 *
 * @Route("/tenders")
 */
class TenderController extends BaseController
{
    /**
     * @var TenderService
     */
    private $service;

    /**
     * TenderController constructor.
     *
     * @param TenderService $service
     */
    public function __construct(TenderService $service)
    {
        $this->service = $service;
    }

    /**
     * @Route("/", methods={"GET"})
     *
     * @param QueryBuilderPaginator $entitiesList
     *
     * @return Response
     */
    public function index(QueryBuilderPaginator $entitiesList)
    {
        $qb = $this
            ->service
            ->getQueryBuilder()
            ->addOrderBy('t.updatedAt', 'DESC');

        return $this->handleResponseView($entitiesList->setQueryBuilder($qb));
    }

    /**
     * Delete tender by id
     *
     * @Route("/{id}/delete", methods={"DELETE"})
     *
     * @param Tender $tender
     *
     * @return Response
     *
     * @throws \Exception
     */
    public function delete(Tender $tender): Response
    {
        $this->service->delete($tender);

        return $this->createSuccessMessage();
    }

    /**
     * Update tender by id
     *
     * @Route("/{id}", methods={"PATCH"})
     *
     * @param Tender $tender
     * @param Entity $entityResponse
     * @param FormFactoryInterface $formFactory
     * @param Request $request
     *
     * @return Response
     * @throws \Exception
     */
    public function update(
        Tender $tender,
        Entity $entityResponse,
        FormFactoryInterface $formFactory,
        Request $request
    ): Response {
        $form = $formFactory->create(CreateType::class, $tender);
        $form->submit($request->request->all());

        if ($form->isValid()) {
            $this->service->updateEntity($tender);

            return $this->handleResponseView($entityResponse->setEntity($tender), 200, ['api']);
        }

        return $this->handleView($this->view($form));
    }

    /**
     * Create new tender
     *
     * @Route("/", methods={"POST"})
     *
     * @param Entity $entityResponse
     * @param FormFactoryInterface $formFactory
     * @param Request $request
     *
     * @return Response
     * @throws \Exception
     */
    public function new(
        Entity $entityResponse,
        FormFactoryInterface $formFactory,
        Request $request
    ): Response {
        $tender = new Tender();
        $form = $formFactory->create(CreateType::class, $tender);
        $form->submit($request->request->all());

        if ($form->isValid()) {
            $this->service->create($tender);

            return $this->handleResponseView($entityResponse->setEntity($tender), 200, ['api']);
        }

        return $this->handleView($this->view($form));
    }
}
