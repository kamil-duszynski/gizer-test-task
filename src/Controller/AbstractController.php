<?php

namespace App\Controller;

use App\Storage\ScoreStorage;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Context\Context;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Response;

abstract class AbstractController extends AbstractFOSRestController
{
    protected ScoreStorage $storage;
    protected PaginatorInterface $paginator;

    public function __construct(ScoreStorage $storage, PaginatorInterface $paginator)
    {
        $this->storage   = $storage;
        $this->paginator = $paginator;
    }

    private function createContext(array $groups): Context
    {
        $context = new Context();
        $context->addGroups($groups);
        $context->setSerializeNull(true);

        return $context;
    }

    protected function renderErrors(array $errors): Response
    {
        $view = $this->view(
            $errors,
            Response::HTTP_BAD_REQUEST
        );

        return $this->handleView($view);
    }

    protected function renderResponse($data = null, array $groups = [], string $statusCode = Response::HTTP_OK): Response
    {
        $view    = $this->view($data, $statusCode);
        $context = $this->createContext($groups);

        $view->setContext($context);

        return $this->handleView($view);
    }
}
