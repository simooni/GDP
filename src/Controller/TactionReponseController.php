<?php

namespace App\Controller;

use App\Entity\TactionReponse;
use App\Entity\Taction;
use App\Form\TactionReponseType;
use App\Entity\Tdocument;
use App\Repository\TactionReponseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * @Route("/taction/reponse")
 */
class TactionReponseController extends AbstractController
{
    /**
     * @Route("/", name="taction_reponse_index", methods={"GET"})
     */
    public function index(TactionReponseRepository $tactionReponseRepository): Response
    {
        return $this->render('taction_reponse/index.html.twig', [
            'taction_reponses' => $tactionReponseRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new{code}", name="taction_reponse_new", methods={"GET","POST"}) 
     */
    public function new($code,Request $request): Response
    {
        $tactionReponse = new TactionReponse();
        $form = $this->createForm(TactionReponseType::class, $tactionReponse);
        $form->handleRequest($request);
        $idtaction = $request->request->get('taction');


        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();

            
            // --------- t_document ---------
 
            $tdocument = new Tdocument();

            $dNow        = new \DateTime(date("Y/m/d"));

            $file = $request->files->get('file');
            $fileName = md5(uniqid()).'+'.str_replace(" ","_",$file->getClientOriginalName());
            $save = $file->move($this->getParameter('brochures_directory'),$fileName);

            $guessExtension = explode('.',$file->getClientOriginalName());
            
            $tdocument->setSlug($fileName);
            $tdocument->setIntitule($request->request->get('intitule-document'));
            $tdocument->setSuspondu('0');
            $tdocument->setdateCreation($dNow);
            $tdocument->setuserCreate($this->getUser()->getUsername());
            $tdocument->setTypeDocument($guessExtension[1]);
            $tdocument->setTaille($request->request->get('size'));
            $tdocument->setCode_nv($code);
            $tdocument->setStatut('Créé');
            $tdocument->setAvancement('0%');

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($tdocument);

            // --------- t_document -----------

            $dNow        = new \DateTime(date("Y/m/d"));
            $tactionReponse->setdateCreation(date("Y/m/d"));
            $tactionReponse->setdateCreationn($dNow);
            $tactionReponse->setuserCreate($this->getUser()->getUsername());
            $tactionReponse->setDocument($tdocument);

            $taction   =  $this->getDoctrine() ->getRepository(Taction::class)->find($idtaction);
            $tactionReponse->setTaction($taction);

            $entityManager->persist($tactionReponse);

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
     * @Route("/{id}", name="taction_reponse_show", methods={"GET"})
     */
    public function show(TactionReponse $tactionReponse): Response
    {
        return $this->render('taction_reponse/show.html.twig', [
            'taction_reponse' => $tactionReponse,
        ]);
    }
    

    /**
     * @Route("/{id}/edit", name="taction_reponse_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, TactionReponse $tactionReponse): Response
    {
        $form = $this->createForm(TactionReponseType::class, $tactionReponse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('taction_reponse_index');
        }

        return $this->render('taction_reponse/edit.html.twig', [
            'taction_reponse' => $tactionReponse,
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/{id}", name="taction_reponse_delete", methods={"DELETE"})
     */
    public function delete(Request $request, TactionReponse $tactionReponse): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tactionReponse->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($tactionReponse);
            $entityManager->flush();
        }

        return $this->redirectToRoute('taction_reponse_index');
    }
}
