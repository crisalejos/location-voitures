<?php

namespace App\Controller;

use App\Entity\Cars;
use App\Form\CarsType;
use App\Repository\CarsRepository;
use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
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
     * @Route("/conditions", name="conditions", methods={"GET"})
     */
    public function conditions(): Response
    {
        return $this->render('site/conditions.html.twig');
    }

    /**
     * @Route("/agence", name="agence", methods={"GET"})
     */
    public function agence(): Response
    {
        return $this->render('site/agence.html.twig');
    }

    /**
     * @Route("/denied_access", name="denied_access")
     */
    public function denied_access(): Response
    {
        return $this->render('site/denied_access.html.twig');
    }
    /**
     * @Route("/error_500", name="error_500")
     */
    public function error_500(): Response
    {
        return $this->render('site/error_500.html.twig');
    }

    /**
     * @Route("/liste_voitures", name="index_cars_home", methods={"GET"})
     */
    public function indexCarHome(CarsRepository $carsRepository): Response
    {
        return $this->render('site/index_cars_home.html.twig', [
            'cars' => $carsRepository->findAll(),
        ]);
    }
    
}
