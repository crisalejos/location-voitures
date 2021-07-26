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
}
