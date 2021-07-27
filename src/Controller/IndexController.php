<?php

namespace App\Controller;

use App\Entity\Cars;
use App\Form\CarsType;
use App\Repository\CarsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/")
 */
class IndexController extends AbstractController
{
    /**
     * @Route("/", name="index", methods={"GET"})
     */
    public function index(CarsRepository $carsRepository): Response
    {
        return $this->render('site/index.html.twig', [
            'cars' => $carsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/site/conditions", name="conditions", methods={"GET"})
     */
    public function conditions(): Response
    {
        return $this->render('site/conditions.html.twig');
    }

    /**
     * @Route("/site/agence", name="agence", methods={"GET"})
     */
    public function agence(): Response
    {
        return $this->render('site/agence.html.twig');
    }
}
