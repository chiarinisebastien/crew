<?php

namespace App\Controller;

use DateTime;
use App\Entity\Intervention;
use App\Form\InterventionType;
use App\Repository\UserRepository;
use App\Repository\YesornoRepository;
use App\Repository\InterventionRepository;
use App\Repository\ServiceRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/intervention")
 */
class InterventionController extends AbstractController
{
    /**
     * @Route("/", name="intervention_index", methods={"GET", "POST"})
     */
    public function index(InterventionRepository $interventionRepository, UserRepository $userRepository, ServiceRepository $serviceRepository): Response
    {        
        $helper = $this->getUser();
        return $this->render('intervention/index.html.twig', [
            'interventions' => $interventionRepository->findBy(array('user' => $helper), array('id' => 'DESC')),
            'users' => $userRepository->findBy(array(), array('firstname' => 'ASC')),
            'services' => $serviceRepository->findBy(array(), array('title' => 'ASC')),
            //'interventions' => $interventionRepository->findAll(),
        ]);
    }
    /**
     * @Route("/resume/{year}/{mois}", name="intervention_resume", methods={"GET"})
     */
    public function resume(InterventionRepository $interventionRepository, $year, $mois): Response
    {        
        $helper = $this->getUser();
        return $this->render('intervention/resume.html.twig', [
            'interventions_par_service' => $interventionRepository->findByService($helper,$year,$mois),
            'interventions_par_user' => $interventionRepository->findBigUser($helper,$year,$mois),
            'nouvelle_intervention_par_service' => $interventionRepository->findNbService($helper,$year,$mois),
            'intervention_group_by_month' => $interventionRepository->findInterByMonth($helper,$year,$mois),
        ]);
    }

    /**
     * @Route("/new", name="intervention_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $intervention = new Intervention();
        $form = $this->createForm(InterventionType::class, $intervention);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $intervention->setUser($this->getUser());
            $entityManager->persist($intervention);
            $entityManager->flush();

            return $this->redirectToRoute('intervention_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('intervention/new.html.twig', [
            'intervention' => $intervention,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="intervention_show", methods={"GET"})
     */
    public function show(Intervention $intervention): Response
    {
        return $this->render('intervention/show.html.twig', [
            'intervention' => $intervention,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="intervention_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Intervention $intervention): Response
    {
        $form = $this->createForm(InterventionType::class, $intervention);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('intervention_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('intervention/edit.html.twig', [
            'intervention' => $intervention,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}/origin", name="origin", methods={"GET","POST"})
     */
    public function origin(Request $request, Intervention $intervention, YesornoRepository $YesornoRepository): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $demande_originale = $intervention->getOrigine()->getId();
        if ($demande_originale == 2) {
            $yesorno = $YesornoRepository->findOneBy(array('id' => 3), array('id' => 'DESC'));
            $intervention->setOrigine($yesorno);
        }
        else {
            $yesorno = $YesornoRepository->findOneBy(array('id' => 2), array('id' => 'DESC'));
            $intervention->setOrigine($yesorno);
        }
        $entityManager->persist($intervention);
        $entityManager->flush();
        return $this->redirectToRoute('intervention_index', [], Response::HTTP_SEE_OTHER);

    }

    /**
     * @Route("/{id}/copy", name="intervention_copy", methods={"GET","POST"})
     */
    public function copy(Intervention $intervention): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $new_intervention = new Intervention();

        $user = $intervention->getUser();
        $new_intervention->setUser($user);

        $agent = $intervention->getAgent();
        $new_intervention->setAgent($agent);

        $service = $intervention->getService();
        $new_intervention->setService($service);

        $origine = $intervention->getOrigine();
        $new_intervention->setOrigine($origine);

        // dd($new_intervention);
        $entityManager->persist($new_intervention);
        $entityManager->flush();
        return $this->redirectToRoute('intervention_index', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * @Route("/{id}/setdatenow", name="intervention_set_date_now", methods={"GET","POST"})
     */
    public function intervention_set_date_now(Intervention $intervention): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        $date_now = new \Datetime();
        $intervention->setCreatedAt($date_now);
        $entityManager->persist($intervention);
        $entityManager->flush();
        return $this->redirectToRoute('intervention_index', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * @Route("/{id}/fermeture", name="intervention_fermeture", methods={"GET","POST"})
     */
    public function fermeture(Intervention $intervention): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $cloture = new DateTime();
        $intervention->setClotureAt($cloture);
        $entityManager->persist($intervention);
        $entityManager->flush();
        return $this->redirectToRoute('intervention_index', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * @Route("/{id}/ouverture", name="intervention_ouverture", methods={"GET","POST"})
     */
    public function ouverture(Intervention $intervention): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $cloture = NULL;
        $intervention->setClotureAt($cloture);
        $entityManager->persist($intervention);
        $entityManager->flush();
        return $this->redirectToRoute('intervention_index', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * @Route("/{id}", name="intervention_delete", methods={"POST"})
     */
    public function delete(Request $request, Intervention $intervention): Response
    {
        if ($this->isCsrfTokenValid('delete'.$intervention->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($intervention);
            $entityManager->flush();
        }

        return $this->redirectToRoute('intervention_index', [], Response::HTTP_SEE_OTHER);
    }
}
