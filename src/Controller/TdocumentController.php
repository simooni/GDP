<?php

namespace App\Controller;

use App\Entity\Tdocument;
use App\Form\TdocumentType;
use App\Repository\TdocumentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\HttpFoundation\JsonResponse;


/**
 * @Route("/tdocument")
 */
class TdocumentController extends AbstractController
{
    /**
     * @Route("/", name="tdocument_index", methods={"GET"})
     */
    public function index(TdocumentRepository $tdocumentRepository): Response
    {
        return $this->render('tdocument/index.html.twig', [
            'tdocuments' => $tdocumentRepository->findAll(),
        ]);
    }

    /**
     * @Route("/test", name="test", methods={"GET","POST"})
     */
    public function test(Request $request): Response
    {

        dd($request->files->get('file'));
        $tdocument = $request->request->get('tdocument');
        $intitule = $tdocument['intitule'];
        $file = $request->files->get('file');
        $fileName = md5(uniqid()).'+'.str_replace(" ","_",$file->getClientOriginalName());
        $save = $file->move($this->getParameter('brochures_directory'),$fileName);
        return new JsonResponse($intitule);
    }

    /**
     * @Route("/new/{code}", name="tdocument_new", methods={"GET","POST"})
     */
    public function new($code, Request $request,ValidatorInterface $validator): Response
    {
        $tdocument = new Tdocument();
        $errors    = $validator->validate($tdocument);
        $form      = $this->createForm(TdocumentType::class, $tdocument);
        $form->handleRequest($request);

        $file = $request->files->get('file');
        
        $id_dossier = $request->request->get('id_dossier');
       
        if ($form->isSubmitted() && $form->isValid() )  {
            $dNow        = new \DateTime(date("Y/m/d"));
            if($file != ""){
                $file = $request->files->get('file');
                $fileName = md5(uniqid()).'+'.str_replace(" ","_",$file->getClientOriginalName());
                $save = $file->move($this->getParameter('brochures_directory'),$fileName);
                // $request->getPathInfo();
                $guessExtension = explode('.',$file->getClientOriginalName());
                
                $tdocument->setSlug($fileName);
                $tdocument->setTypeDocument($guessExtension[1]) ;
            }
            if($id_dossier != ""){
                $Tdocument   =  $this->getDoctrine() ->getRepository(Tdocument::class)->find($id_dossier);
                $tdocument->setFolder($Tdocument);
                
                
            }
            

            $tdocument->setSuspondu('0');
            $tdocument->setdateCreation($dNow);
            $tdocument->setuserCreate($this->getUser()->getUsername());
            
            $tdocument->setTaille($request->request->get('size'));
            $tdocument->setCode_nv($code);
            $tdocument->setStatut('Créé');
            $tdocument->setAvancement('0%');
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($tdocument);
            $entityManager->flush();

            return new JsonResponse('ok');
        }else{

            foreach ($form->getErrors(true) as $error) {
                $ers[$error->getOrigin()->getName()] = $error->getMessage();
            }
            if(empty($file))
            $ers['fileInput'] = "veuillez remplir ce champ";
            return new JsonResponse($ers);
        }

    }

    /**
     * @Route("/newfolder/{code}", name="tdocument_folder_new", methods={"GET","POST"})
     */
    public function newfolder($code, Request $request,ValidatorInterface $validator): Response
    {
        $tdocument = new Tdocument();
        $form      = $this->createForm(TdocumentType::class, $tdocument);
        $form->handleRequest($request);
        // dd('test');
        $id_dossier = $request->request->get('id_dossier');
        $dossies = json_decode($request->request->get('dossies'));
        $entityManager = $this->getDoctrine()->getManager();
        
        if ($form->isSubmitted() && $form->isValid() )  {
            $dNow        = new \DateTime(date("Y/m/d"));
          
            if($id_dossier != ""){

                $Tdocument   =  $this->getDoctrine() ->getRepository(Tdocument::class)->find($id_dossier);
                
                foreach ($dossies as $dossie) {
                   
                    $tdocument = new Tdocument();
                    $errors    = $validator->validate($tdocument);
                    $tdocument->setIntitule($dossie->intitule);
                    $tdocument->setFolder($Tdocument);
                    $tdocument->setSuspondu('0');
                    $tdocument->setdateCreation($dNow);
                    $tdocument->setuserCreate($this->getUser()->getUsername());
                    $tdocument->setTypeDocument('Dossier');
                    
                    $tdocument->setCode_nv($code);
                    $tdocument->setStatut('Créé');
                    $tdocument->setAvancement('0%');
                    
                    $entityManager->persist($tdocument);
                }
                  
            } 
            else{
                
                
                $errors    = $validator->validate($tdocument);
                $tdocument->setSuspondu('0');
                $tdocument->setdateCreation($dNow);
                $tdocument->setuserCreate($this->getUser()->getUsername());
                $tdocument->setTypeDocument('Dossier');
                
                $tdocument->setCode_nv($code);
                $tdocument->setStatut('Créé');
                $tdocument->setAvancement('0%');
                $entityManager->persist($tdocument);
            }
             
            
            $entityManager->flush();

            return new JsonResponse('ok');
        }

    }

    /**
     * @Route("/{id}", name="tdocument_show", methods={"GET"})
     */
    public function show(Tdocument $tdocument): Response
    {
        return $this->render('tdocument/show.html.twig', [
            'tdocument' => $tdocument,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="tdocument_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Tdocument $tdocument): Response
    {
        $form = $this->createForm(TdocumentType::class, $tdocument);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            
            $this->getDoctrine()->getManager()->flush();

            return new JsonResponse('ok');
            
        }else{

            foreach ($form->getErrors(true) as $error) {
                $ers[$error->getOrigin()->getName()] = $error->getMessage();
            }
            if(empty($file))
            $ers['fileInput'] = "veuillez remplir ce champ";
            return new JsonResponse($ers);
        }
    }

    /**
     * @Route("/{id}", name="tdocument_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Tdocument $tdocument): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tdocument->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($tdocument);
            $entityManager->flush();
        }

        return $this->redirectToRoute('tdocument_index');
    }

    /**
     * @Route("/suspendre/{id}", name="tdocument_suspendre", methods={"GET","POST"})
     */
    public function suspendre(Request $request, Tdocument $tdocument): Response
    {
        if ($this->isCsrfTokenValid('suspendre'.$tdocument->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $tdocument->setSuspondu('1');
            $entityManager->persist($tdocument);
            $entityManager->flush();
            return new JsonResponse('ok');
        }else{
            return new JsonResponse('error');
        }

    }

    /**
     * @Route("/cloturer/{id}", name="tdocument_cloturer", methods={"GET","POST"})
     */
    public function cloturer(Request $request, Tdocument $tdocument): Response
    {
        if ($this->isCsrfTokenValid('cloturer'.$tdocument->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $tdocument->setCloturer('1');
            $tdocument->setAnnuler('0');
            $entityManager->persist($tdocument);
            $entityManager->flush();
            return new JsonResponse('ok');
        }else{
            return new JsonResponse('error');
        }

    }

    /**
     * @Route("/annuler/{id}", name="tdocument_annuler", methods={"GET","POST"})
     */
    public function annuler(Request $request, Tdocument $tdocument): Response
    {
        if ($this->isCsrfTokenValid('annuler'.$tdocument->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $tdocument->setAnnuler('1');
            $tdocument->setCloturer('0');
            $entityManager->persist($tdocument);
            $entityManager->flush();
            return new JsonResponse('ok');
        }else{
            return new JsonResponse('error');
        }

    }

    /**
     * @Route("/statut/{id}/{stut}", name="tdocument-statuts", methods={"GET","POST"})
     */
    public function statut($stut,Request $request, Tdocument $tdocument): Response
    {
        if ($this->isCsrfTokenValid('statut'.$tdocument->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $tdocument->setAnnuler('0');
            $tdocument->setCloturer('0');
            $tdocument->setStatut($stut);
            $entityManager->persist($tdocument);
            $entityManager->flush();
            return new JsonResponse('ok');
        }else{
            return new JsonResponse('error');
        }

    }


}
