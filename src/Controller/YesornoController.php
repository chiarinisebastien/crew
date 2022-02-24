<?php

namespace App\Controller;

use App\Entity\Yesorno;
use App\Form\YesornoType;
use App\Repository\YesornoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/yesorno")
 */
class YesornoController extends AbstractController
{
    /**
     * @Route("/", name="yesorno_index", methods={"GET"})
     */
    public function index(YesornoRepository $yesornoRepository): Response
    {
        return $this->render('yesorno/index.html.twig', [
            'yesornos' => $yesornoRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="yesorno_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $yesorno = new Yesorno();
        $form = $this->createForm(YesornoType::class, $yesorno);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($yesorno);
            $entityManager->flush();

            return $this->redirectToRoute('yesorno_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('yesorno/new.html.twig', [
            'yesorno' => $yesorno,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="yesorno_show", methods={"GET"})
     */
    public function show(Yesorno $yesorno): Response
    {
        return $this->render('yesorno/show.html.twig', [
            'yesorno' => $yesorno,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="yesorno_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Yesorno $yesorno): Response
    {
        $form = $this->createForm(YesornoType::class, $yesorno);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('yesorno_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('yesorno/edit.html.twig', [
            'yesorno' => $yesorno,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="yesorno_delete", methods={"POST"})
     */
    public function delete(Request $request, Yesorno $yesorno): Response
    {
        if ($this->isCsrfTokenValid('delete'.$yesorno->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($yesorno);
            $entityManager->flush();
        }

        return $this->redirectToRoute('yesorno_index', [], Response::HTTP_SEE_OTHER);
    }
}
