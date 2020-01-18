<?php

namespace App\Controller\Api;

use App\Response\ResponseData;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Context\Context;
use FOS\RestBundle\Controller\ControllerTrait;
use FOS\RestBundle\View\ViewHandlerInterface;

/**
 * Class BaseController
 */
abstract class BaseController
{
    use ControllerTrait;

    /**
     * @param ViewHandlerInterface $viewhandler
     *
     * @required
     */
    public function setViewHandler(ViewHandlerInterface $viewhandler)
    {
        $this->viewhandler = $viewhandler;
    }

    /**
     * @param ResponseData $data
     * @param int          $statusCode
     * @param array|null   $serializeGroups
     *
     * @return Response
     */
    protected function handleResponseView(
        ResponseData $data,
        $statusCode = 200,
        array $serializeGroups = null
    ): Response {
        $view = $this->view($data->getResponseArray(), $statusCode);

        if (null != $serializeGroups) {
            $context = new Context();
            $context->setGroups($serializeGroups);
            $view->setContext($context);
        }

        return $this->handleView($view);
    }

    /**
     * Returns success message
     *
     * @return Response
     *
     * @final
     */
    protected function createSuccessMessage(): Response
    {
        return new JsonResponse(['success' => true]);
    }
}
