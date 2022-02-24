<?php

namespace App\Controller;

use App\Entity\ListeTache;
use App\Form\ListeTacheType;
use App\Repository\ListeTacheRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/liste/tache")
 */
class ListeTacheController extends AbstractController
{
    /**
     * @Route("/", name="liste_tache_index", methods={"GET"})
     */
    public function index(ListeTacheRepository $listeTacheRepository): Response
    {
        return $this->render('liste_tache/index.html.twig', [
            'liste_taches' => $listeTacheRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="liste_tache_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $listeTache = new ListeTache();
        $form = $this->createForm(ListeTacheType::class, $listeTache);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($listeTache);
            $entityManager->flush();

            return $this->redirectToRoute('liste_tache_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('liste_tache/new.html.twig', [
            'liste_tache' => $listeTache,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="liste_tache_show", methods={"GET"})
     */
    public function show(ListeTache $listeTache): Response
    {
        return $this->render('liste_tache/show.html.twig', [
            'liste_tache' => $listeTache,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="liste_tache_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, ListeTache $listeTache): Response
    {
        $form = $this->createForm(ListeTacheType::class, $listeTache);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('liste_tache_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('liste_tache/edit.html.twig', [
            'liste_tache' => $listeTache,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="liste_tache_delete", methods={"POST"})
     */
    public function delete(Request $request, ListeTache $listeTache): Response
    {
        if ($this->isCsrfTokenValid('delete'.$listeTache->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($listeTache);
            $entityManager->flush();
        }

        return $this->redirectToRoute('nom_liste_tache_index', [], Response::HTTP_SEE_OTHER);
    }
}
