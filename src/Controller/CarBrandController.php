<?php

namespace App\Controller;

use App\Entity\CarBrand;
use App\Form\CarBrandType;
use App\Repository\CarBrandRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/car/brand")
 */
class CarBrandController extends AbstractController
{
    /**
     * @Route("/", name="car_brand_index", methods={"GET"})
     */
    public function index(CarBrandRepository $carBrandRepository): Response
    {
        return $this->render('car_brand/index.html.twig', [
            'car_brands' => $carBrandRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="car_brand_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $carBrand = new CarBrand();
        $form = $this->createForm(CarBrandType::class, $carBrand);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($carBrand);
            $entityManager->flush();

            return $this->redirectToRoute('car_brand_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('car_brand/new.html.twig', [
            'car_brand' => $carBrand,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="car_brand_show", methods={"GET"})
     */
    public function show(CarBrand $carBrand): Response
    {
        return $this->render('car_brand/show.html.twig', [
            'car_brand' => $carBrand,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="car_brand_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CarBrand $carBrand): Response
    {
        $form = $this->createForm(CarBrandType::class, $carBrand);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('car_brand_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('car_brand/edit.html.twig', [
            'car_brand' => $carBrand,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="car_brand_delete", methods={"POST"})
     */
    public function delete(Request $request, CarBrand $carBrand): Response
    {
        if ($this->isCsrfTokenValid('delete'.$carBrand->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($carBrand);
            $entityManager->flush();
        }

        return $this->redirectToRoute('car_brand_index', [], Response::HTTP_SEE_OTHER);
    }
}
