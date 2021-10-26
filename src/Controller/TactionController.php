<?php

namespace App\Controller;

use App\Entity\Taction;
use App\Entity\Tdocument;
use App\Form\TactionType;
use App\Entity\TypeAction;
use App\Entity\Urgence;
use App\Repository\TactionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;


/**
 * @Route("/taction")
 */
class TactionController extends AbstractController
{
    // /**
    //  * @Route("/", name="taction_index", methods={"GET"})
    //  */
    // public function index(TactionRepository $tactionRepository): Response
    // {
    //     return $this->render('taction/index.html.twig', [
    //         'tactions' => $tactionRepository->findAll(),
    //     ]);
    // }

    /**
     * @Route("/current/{id}", name="current", methods={"GET","POST"})
     */
    public function current(Taction $taction,$id): Response
    {

        $action['intitule'] = $taction->getIntitule();
        $action['Taction'] = $taction->getTaction()->getId();
        $action['etatUrgence'] = $taction->getetatUrgence()->getId();
        return new JsonResponse($action);

        // $data =  $this->get('serializer')->serialize($taction, 'json');
        // $response = new Response($data);
        // $response->headers->set('Content-Type', 'application/json');
        // return $response;
    }
 
    /**
     * @Route("/new/{code}", name="taction_new", methods={"GET","POST"})
     */
    public function new($code, Request $request): Response
    {
        $taction = new Taction();
        $form = $this->createForm(TactionType::class, $taction);
        $form->handleRequest($request);
        $id_dossier = $request->request->get('id_dossier');

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            
            $dNow        = new \DateTime(date("Y/m/d"));
            $taction->setdateCreation($dNow);
            $taction->setuserCreate($this->getUser()->getUsername());
            $taction->setActive(1);
            $taction->setsuspendre(0);
            $taction->setCodeNv($code);
            $taction->setStatut('Créé');
            if($id_dossier != ""){
                $tdocument   =  $this->getDoctrine() ->getRepository(Tdocument::class)->find($id_dossier);
                $taction->setDossier($tdocument);
               
            }

            $entityManager->persist($taction);
            $entityManager->flush();

            return new JsonResponse('ok');
        }else{

            foreach ($form->getErrors(true) as $error) {
                $ers[$error->getOrigin()->getName()] = $error->getMessage();
            }
            return new JsonResponse($ers);
        }

    }


    /**
     * @Route("/{id}/edit", name="taction_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Taction $taction): Response
    {
        $form = $this->createForm(TactionType::class, $taction);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return new JsonResponse('ok');
            
        }else{

            foreach ($form->getErrors(true) as $error) {
                $ers[$error->getOrigin()->getName()] = $error->getMessage();
            }
            return new JsonResponse($ers);
        }
    }

    /**
     * @Route("/suspendre/{id}", name="taction_suspendre", methods={"GET","POST"})
     */
    public function suspendre(Request $request, Taction $taction): Response
    {
        if ($this->isCsrfTokenValid('suspendre'.$taction->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $taction->setsuspendre('1');
            $entityManager->persist($taction);
            $entityManager->flush();
            return new JsonResponse('ok');
        }else{
            return new JsonResponse('error');
        }

    }

    /**
     * @Route("/cloturer/{id}", name="taction_cloturer", methods={"GET","POST"})
     */
    public function cloturer(Request $request, Taction $taction): Response
    {
        if ($this->isCsrfTokenValid('cloturer'.$taction->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $taction->setCloturer('1');
            $taction->setAnnuler('0');
            $entityManager->persist($taction);
            $entityManager->flush();
            return new JsonResponse('ok');
        }else{
            return new JsonResponse('error');
        }

    }
     /**
     * @Route("/annuler/{id}", name="taction_annuler", methods={"GET","POST"})
     */
    public function annuler(Request $request, Taction $taction): Response
    {
        if ($this->isCsrfTokenValid('annuler'.$taction->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $taction->setAnnuler('1');
            $taction->setCloturer('0');
            $entityManager->persist($taction);
            $entityManager->flush();
            return new JsonResponse('ok');
        }else{
            return new JsonResponse('error');
        }

    }


       /**
     * @Route("/statut/{id}/{stut}", name="Taction-statuts", methods={"GET","POST"})
     */
    public function statut($stut,Request $request, Taction $taction): Response
    {
        if ($this->isCsrfTokenValid('statut'.$taction->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $taction->setAnnuler('0');
            $taction->setCloturer('0');
            $taction->setStatut($stut);
            $entityManager->persist($taction);
            $entityManager->flush();
            return new JsonResponse('ok');
        }else{
            return new JsonResponse('error');
        }

    }



    // /**
    //  * @Route("/{id}", name="taction_delete", methods={"DELETE"})
    //  */
    // public function delete(Request $request, Taction $taction): Response
    // {
    //     if ($this->isCsrfTokenValid('delete'.$taction->getId(), $request->request->get('_token'))) {
    //         $entityManager = $this->getDoctrine()->getManager();
    //         $entityManager->remove($taction);
    //         $entityManager->flush();
    //     }

    //     return $this->redirectToRoute('taction_index');
    // }

    
    // /**
    //  * @Route("/{id}", name="taction_show", methods={"GET"})
    //  */
    // public function show(Taction $taction): Response
    // {
    //     return $this->render('taction/show.html.twig', [
    //         'taction' => $taction,
    //     ]);
    // }


}
