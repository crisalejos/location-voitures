<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/conditions")
 */
class ConditionsController extends AbstractController
{
    /**
     * @Route("/conditions", name="conditions", methods={"GET"})
     */
    public function conditions(): Response
    {
        return $this->render('site/conditions.html.twig');
    }
}
