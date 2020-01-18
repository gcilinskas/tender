<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

trait RequestTrait
{
    /** @var RequestStack */
    protected $requestStack;

    /** @var Request */
    protected $request;

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
