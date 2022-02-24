<?php

namespace App\Controller;

use App\Entity\Identifiant;
use App\Form\IdentifiantType;
use App\Repository\IdentifiantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/identifiant")
 */
class IdentifiantController extends AbstractController
{
    /**
     * @Route("/", name="identifiant_index", methods={"GET"})
     */
    public function index(IdentifiantRepository $identifiantRepository): Response
    {
        $user = $this->getUser();
        return $this->render('identifiant/index.html.twig', [
            'identifiants' => $identifiantRepository->findBy(array('user' => $user), array('id' => 'DESC')),
        ]);
    }

    /**
     * @Route("/new", name="identifiant_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $identifiant = new Identifiant();
        $form = $this->createForm(IdentifiantType::class, $identifiant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $identifiant->setUser($this->getUser());
            $entityManager->persist($identifiant);
            $entityManager->flush();

            return $this->redirectToRoute('identifiant_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('identifiant/new.html.twig', [
            'identifiant' => $identifiant,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="identifiant_show", methods={"GET"})
     */
    public function show(Identifiant $identifiant): Response
    {
        return $this->render('identifiant/show.html.twig', [
            'identifiant' => $identifiant,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="identifiant_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Identifiant $identifiant): Response
    {
        $form = $this->createForm(IdentifiantType::class, $identifiant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('identifiant_index', [], Response::HTTP_SEE_OTHER);
        }

        // dd($identifiant);

        return $this->renderForm('identifiant/edit.html.twig', [
            'identifiant' => $identifiant,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="identifiant_delete", methods={"POST"})
     */
    public function delete(Request $request, Identifiant $identifiant): Response
    {
        if ($this->isCsrfTokenValid('delete'.$identifiant->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($identifiant);
            $entityManager->flush();
        }

        return $this->redirectToRoute('identifiant_index', [], Response::HTTP_SEE_OTHER);
    }
}
