<?php

namespace App\Controller;

use App\Entity\AdminDeparture;
use App\Form\AdminDepartureType;
use App\Repository\AdminDepartureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/departure")
 */
class AdminDepartureController extends AbstractController
{
    /**
     * @Route("/", name="admin_departure_index", methods={"GET"})
     */
    public function index(AdminDepartureRepository $adminDepartureRepository): Response
    {
        return $this->render('admin_departure/index.html.twig', [
            'admin_departures' => $adminDepartureRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="admin_departure_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $adminDeparture = new AdminDeparture();
        $form = $this->createForm(AdminDepartureType::class, $adminDeparture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($adminDeparture);
            $entityManager->flush();

            return $this->redirectToRoute('admin_departure_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_departure/new.html.twig', [
            'admin_departure' => $adminDeparture,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="admin_departure_show", methods={"GET"})
     */
    public function show(AdminDeparture $adminDeparture): Response
    {
        return $this->render('admin_departure/show.html.twig', [
            'admin_departure' => $adminDeparture,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin_departure_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, AdminDeparture $adminDeparture): Response
    {
        $form = $this->createForm(AdminDepartureType::class, $adminDeparture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_departure_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_departure/edit.html.twig', [
            'admin_departure' => $adminDeparture,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="admin_departure_delete", methods={"POST"})
     */
    public function delete(Request $request, AdminDeparture $adminDeparture): Response
    {
        if ($this->isCsrfTokenValid('delete'.$adminDeparture->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($adminDeparture);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_departure_index', [], Response::HTTP_SEE_OTHER);
    }
}
