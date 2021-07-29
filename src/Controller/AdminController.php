<?php

namespace App\Controller;

use App\Entity\Cars;
use App\Form\CarsType;
use App\Repository\CarsRepository;
use App\Repository\BookingRepository;
use App\Entity\Booking;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @IsGranted("ROLE_ADMIN")
 * @Route("/gestion")
 */
class AdminController extends AbstractController
{
    /**
     * @Route("/", name="admin_home", methods={"GET"})
     */
    public function admin_home(): Response
    {
        return $this->render('service/index.html.twig');
    }

    /**
     * @Route("/clients", name="admin_user_index", methods={"GET"})
     */
    public function adminUserIndex(UserRepository $userRepository): Response
    {
        return $this->render('user/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }

    /**
     * @Route("/reservations", name="admin_booking_index", methods={"GET"})
     */
    public function adminBookingIndex(BookingRepository $bookingRepository): Response
    {
        return $this->render('booking/index.html.twig', [
            'bookings' => $bookingRepository->findAll(),
        ]);
    }

    /**
     * @Route("/reservations", name="booking_search", methods={"GET","POST"})
     */
    public function bookingSearch(BookingRepository $bookingRepository, Request $request): Response
    {
        return $this->render('booking/index.html.twig', [
            'bookings' => $bookingRepository->findByDate($request->request->get('search'))
        ]);
    } 

    /**
     * @Route("/liste-de-voitures", name="admin_cars_index", methods={"GET"})
     */
    public function adminCarsIndex(CarsRepository $carsRepository): Response
    {
        return $this->render('cars/index.html.twig', [
            'cars' => $carsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/nouvelle-voiture", name="admin_cars_new", methods={"GET","POST"})
     */
    public function adminCarsNew(Request $request): Response
    {
        $car = new Cars();
        $form = $this->createForm(CarsType::class, $car);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($car);
            $entityManager->flush();

            return $this->redirectToRoute('cars_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('cars/new.html.twig', [
            'car' => $car,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{title}", name="cars_show", methods={"GET"})
     */
    public function showCar(Cars $car): Response
    {
        return $this->render('cars/show.html.twig', [
            'car' => $car,
        ]);
    }

    /**
     * @Route("/{title}/edit", name="cars_edit", methods={"GET","POST"})
     */
    public function editCar(Request $request, Cars $car): Response
    {
        $form = $this->createForm(CarsType::class, $car);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('cars_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('cars/edit.html.twig', [
            'car' => $car,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{title}", name="cars_delete", methods={"POST"})
     */
    public function deleteCar(Request $request, Cars $car): Response
    {
        if ($this->isCsrfTokenValid('delete'.$car->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($car);
            $entityManager->flush();
        }

        return $this->redirectToRoute('cars_index', [], Response::HTTP_SEE_OTHER);
    }
    
    /**
     * @Route("/clients", name="user_search", methods={"GET","POST"})
     */
    public function search(UserRepository $userRepository, Request $request): Response
    {
        return $this->render('user/index.html.twig', [
            'users' => $userRepository->findByNameOrFirstName($request->request->get('search'))
        ]);
    } 

    
   
}
