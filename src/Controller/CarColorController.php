<?php

namespace App\Controller;

use App\Entity\CarColor;
use App\Form\CarColorType;
use App\Repository\CarColorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/car/color")
 */
class CarColorController extends AbstractController
{
    /**
     * @Route("/", name="car_color_index", methods={"GET"})
     */
    public function index(CarColorRepository $carColorRepository): Response
    {
        return $this->render('car_color/index.html.twig', [
            'car_colors' => $carColorRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="car_color_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $carColor = new CarColor();
        $form = $this->createForm(CarColorType::class, $carColor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($carColor);
            $entityManager->flush();

            return $this->redirectToRoute('car_color_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('car_color/new.html.twig', [
            'car_color' => $carColor,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="car_color_show", methods={"GET"})
     */
    public function show(CarColor $carColor): Response
    {
        return $this->render('car_color/show.html.twig', [
            'car_color' => $carColor,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="car_color_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CarColor $carColor): Response
    {
        $form = $this->createForm(CarColorType::class, $carColor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('car_color_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('car_color/edit.html.twig', [
            'car_color' => $carColor,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="car_color_delete", methods={"POST"})
     */
    public function delete(Request $request, CarColor $carColor): Response
    {
        if ($this->isCsrfTokenValid('delete'.$carColor->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($carColor);
            $entityManager->flush();
        }

        return $this->redirectToRoute('car_color_index', [], Response::HTTP_SEE_OTHER);
    }
}
