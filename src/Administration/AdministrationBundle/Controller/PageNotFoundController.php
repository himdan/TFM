<?php

namespace Administration\AdministrationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PageNotFoundController extends Controller
{

    public function pageNotFoundAction()
    {
        return $this->render('@Projet/Default/403.html.twig');

    }

}