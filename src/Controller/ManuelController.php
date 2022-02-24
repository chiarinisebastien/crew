<?php

namespace App\Controller;

use App\Entity\Manuel;
use App\Form\ManuelType;
use App\Repository\ManuelRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/manuel")
 */
class ManuelController extends AbstractController
{
    /**
     * @Route("/", name="manuel_index", methods={"GET"})
     */
    public function index(ManuelRepository $manuelRepository): Response
    {
        $auteur = $this->getUser();
        return $this->render('manuel/index.html.twig', [
            // 'manuels' => $manuelRepository->findAll(),
            'manuels' => $manuelRepository->findBy(array('auteur' => $auteur), array('id' => 'DESC')),
        ]);
    }

    /**
     * @Route("/new", name="manuel_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $manuel = new Manuel();
        $form = $this->createForm(ManuelType::class, $manuel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $manuel->setAuteur($this->getUser());
            $entityManager->persist($manuel);
            $entityManager->flush();

            return $this->redirectToRoute('manuel_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('manuel/new.html.twig', [
            'manuel' => $manuel,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="manuel_show", methods={"GET"})
     */
    public function show(Manuel $manuel): Response
    {
        return $this->render('manuel/show.html.twig', [
            'manuel' => $manuel,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="manuel_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Manuel $manuel): Response
    {
        $form = $this->createForm(ManuelType::class, $manuel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('manuel_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('manuel/edit.html.twig', [
            'manuel' => $manuel,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="manuel_delete", methods={"POST"})
     */
    public function delete(Request $request, Manuel $manuel): Response
    {
        if ($this->isCsrfTokenValid('delete'.$manuel->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($manuel);
            $entityManager->flush();
        }

        return $this->redirectToRoute('manuel_index', [], Response::HTTP_SEE_OTHER);
    }
}
