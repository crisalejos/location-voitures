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
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
//  * @IsGranted("ROLE_USER") use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @IsGranted("ROLE_USER")
 * @Route("/service")
 */
class ServiceController extends AbstractController
{
    /**
     * @Route("/", name="service_home", methods={"GET"})
     */
    public function service_home(): Response
    {
        return $this->render('service/index.html.twig');
    }

    /**
     * @Route("/voitures-en-location", name="service_car_list", methods={"GET"})
     */
    public function serviceCarList(CarsRepository $carsRepository): Response
    {
        return $this->render('service/service_car_list.html.twig', [
            'cars' => $carsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/{id}", name="service_user_show", methods={"GET"})
     */
    public function service_user_show(User $user): Response
    {
        
        return $this->render('service/service_user_show.html.twig', [
            'user' => $user,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="service_user_edit", methods={"GET","POST"})
     */
    public function service_user_edit(Request $request, User $user): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('service_home', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('service/service_user_edit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/mes-reservations", name="service_booking_index", methods={"GET"})
     */
    public function index(BookingRepository $bookingRepository): Response
    {
        return $this->render('service/service_booking_index.html.twig', [
            'bookings' => $bookingRepository->find($bookingRepository),
        ]);
    }

    

   
}
