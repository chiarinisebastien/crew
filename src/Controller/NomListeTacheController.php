<?php

namespace App\Controller;

use App\Entity\ListeTache;
use App\Entity\Intervention;
use App\Form\ListeTacheType;
use App\Entity\NomListeTache;
use App\Form\NomListeTacheType;
use App\Repository\UserRepository;
use App\Repository\ListeTacheRepository;
use App\Repository\NomListeTacheRepository;
use App\Repository\YesornoRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/nom/liste/tache")
 */
class NomListeTacheController extends AbstractController
{
    /**
     * @Route("/", name="nom_liste_tache_index", methods={"GET"})
     */
    public function index(NomListeTacheRepository $nomListeTacheRepository): Response
    {
        $user = $this->getUser();
        return $this->render('nom_liste_tache/index.html.twig', [
            // 'nom_liste_taches' => $nomListeTacheRepository->findAll(),
            'nom_liste_taches' => $nomListeTacheRepository->findBy(array('user' => $user)),
        ]);
    }

    /**
     * @Route("/new", name="nom_liste_tache_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $nomListeTache = new NomListeTache();
        $form = $this->createForm(NomListeTacheType::class, $nomListeTache);
        $form->handleRequest($request);
        $user = $this->getUser();
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $nomListeTache->setUser($user);
            $entityManager->persist($nomListeTache);
            $entityManager->flush();

            return $this->redirectToRoute('nom_liste_tache_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('nom_liste_tache/new.html.twig', [
            'nom_liste_tache' => $nomListeTache,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="nom_liste_tache_show", methods={"GET"})
     */
    public function show(NomListeTache $nomListeTache): Response
    {
        return $this->render('nom_liste_tache/show.html.twig', [
            'nom_liste_tache' => $nomListeTache,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="nom_liste_tache_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, NomListeTache $nomListeTache, ListeTacheRepository $listeTacheRepository, UserRepository $userRepository): Response
    {
        $form = $this->createForm(NomListeTacheType::class, $nomListeTache);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('nom_liste_tache_index', [], Response::HTTP_SEE_OTHER);
        }

        
        $listeTache = new ListeTache();
        $formTache = $this->createForm(ListeTacheType::class, $listeTache);
        $formTache->handleRequest($request);
        $user = $this->getUser();

        if ($formTache->isSubmitted() && $formTache->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $listeTache->setHelper($user);
            $listeTache->setListe($nomListeTache);
            $entityManager->persist($listeTache);
            $entityManager->flush();

            return $this->redirectToRoute('nom_liste_tache_edit', array('id'=>$nomListeTache->getId()));
        }

        return $this->renderForm('nom_liste_tache/edit.html.twig', [
            'nom_liste_tache' => $nomListeTache,
            'form' => $form,
            'formTache' => $formTache,
            'liste_tache_planifiees' => $listeTacheRepository -> findBy(array('liste'=>$nomListeTache)),
            'users' => $userRepository -> findAll(),
        ]);
    }

    /**
     * @Route("/{id}", name="nom_liste_tache_delete", methods={"POST"})
     */
    public function delete(Request $request, NomListeTache $nomListeTache): Response
    {
        if ($this->isCsrfTokenValid('delete'.$nomListeTache->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($nomListeTache);
            $entityManager->flush();
        }

        return $this->redirectToRoute('nom_liste_tache_index', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * @Route("/add/{add}", name="nom_liste_tache_add_to_inter", methods={"POST"})
     */
    public function nom_liste_tache_add_to_inter(Request $request, ListeTacheRepository $listeTacheRepository, UserRepository $userRepository, YesornoRepository $yesornoRepository): Response
    {
        $liste = $request->get("liste");
        $liste = $listeTacheRepository->findBy(array('liste' => $liste), array('id' => 'DESC'));
        
        $agent = $request -> get("choix_agent");
        $array_agent = explode(" ",$agent);
        $firstname = $array_agent[0];
        $lastname = $array_agent[1];
        $agent = $userRepository->findOneBy(array('firstname'=>$firstname, 'lastname'=>$lastname));
        $agent_id = $agent -> getId();
        
        $yesorno = $yesornoRepository->findOneBy(array('id' => 3), array('id' => 'DESC'));

         foreach ($liste as $value) {
            $intervention = new Intervention();

            $user = $this->getUser();
            $intervention->setUser($user);            

            $intervention->setAgent($agent);

            $service = $value->getService();
            $intervention->setService($service);
            
            $intervention->setOrigine($yesorno);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($intervention);
            $entityManager->flush();
        }
        return $this->redirectToRoute('intervention_index');
    }
}
