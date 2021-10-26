<?php

namespace App\Controller;

use App\Entity\TdocumentVersion;
use App\Form\TdocumentVersionType;
use App\Repository\TdocumentVersionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Entity\Tdocument;


/**
 * @Route("/tdocument/version")
 */
class TdocumentVersionController extends AbstractController
{
    
    /**
     * @Route("/new", name="tdocument_version_new", methods={"GET","POST"})
     */
    public function new(Request $request,ValidatorInterface $validator): Response
    {
        $tdocumentVersion = new TdocumentVersion();
        $errors    = $validator->validate($tdocumentVersion);
        $form = $this->createForm(TdocumentVersionType::class, $tdocumentVersion);
        $form->handleRequest($request);

        $file = $request->files->get('file');
        $idVdocument = $request->request->get('idVdocument');

        if ($form->isSubmitted() && $form->isValid() && $file != ""){
 
            $dNow = new \DateTime(date("Y/m/d"));
            $file = $request->files->get('file');
            $fileName = md5(uniqid()).'+'.str_replace(" ","_",$file->getClientOriginalName());
            $save = $file->move($this->getParameter('brochures_directory'),$fileName);

            $guessExtension = explode('.',$file->getClientOriginalName());
            
            $tdocumentVersion->setSlug($fileName);
            $tdocumentVersion->setdateCreation($dNow);
            $tdocumentVersion->setuserCreate($this->getUser()->getUsername());
            $tdocumentVersion->setTypeDocument($guessExtension[1]);
            $tdocumentVersion->setTaille($request->request->get('size'));
            // $tdocumentVersion->setObservation('observation');

            $Tdocument   =  $this->getDoctrine() ->getRepository(Tdocument::class)->find($idVdocument);
            $tdocumentVersion->setDocument($Tdocument);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($tdocumentVersion);
            $entityManager->flush();

            return new JsonResponse('ok');
        }else{

            foreach ($form->getErrors(true) as $error) {
                $ers[$error->getOrigin()->getName()] = $error->getMessage();
            }
            if(empty($file))
            $ers['fileInput'] = "veuillez remplir ce champ";
            // dd($ers);
            return new JsonResponse($ers);
        }
    }


    /**
     * @Route("/suspendre/{id}", name="TdocumentVersion_suspendre", methods={"GET","POST"})
     */
    public function suspendre(Request $request, TdocumentVersion $tdocumentVersion): Response
    {
        if ($this->isCsrfTokenValid('suspendre'.$tdocumentVersion->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $tdocumentVersion->setSuspondu('1');
            $entityManager->persist($tdocumentVersion);
            $entityManager->flush();
            return new JsonResponse('ok');
        }else{
            return new JsonResponse('error');
        }

    }

    // /**
    //  * @Route("/new", name="tdocument_new", methods={"GET","POST"})
    //  */
    // public function new(Request $request,ValidatorInterface $validator): Response
    // {
    //     $tdocument = new Tdocument();
    //     $errors    = $validator->validate($tdocument);
    //     $form      = $this->createForm(TdocumentType::class, $tdocument);
    //     $form->handleRequest($request);

    //     $file = $request->files->get('file');
        
    //     if ($form->isSubmitted() && $form->isValid() && $file != "")  {
    //         $dNow        = new \DateTime(date("Y/m/d"));

    //         $file = $request->files->get('file');
    //         $fileName = md5(uniqid()).'+'.str_replace(" ","_",$file->getClientOriginalName());
    //         $save = $file->move($this->getParameter('brochures_directory'),$fileName);

    //         $guessExtension = explode('.',$file->getClientOriginalName());
            
    //         $tdocument->setSlug($fileName);
    //         $tdocument->setSuspondu('0');
    //         $tdocument->setdateCreation($dNow);
    //         $tdocument->setuserCreate($this->getUser()->getUsername());
    //         $tdocument->setTypeDocument($guessExtension[1]);
    //         $tdocument->setTaille($request->request->get('size'));

    //         $entityManager = $this->getDoctrine()->getManager();
    //         $entityManager->persist($tdocument);
    //         $entityManager->flush();

    //         return new JsonResponse('ok');
    //     }else{

    //         foreach ($form->getErrors(true) as $error) {
    //             $ers[$error->getOrigin()->getName()] = $error->getMessage();
    //         }
    //         if(empty($file))
    //         $ers['fileInput'] = "veuillez remplir ce champ";
    //         return new JsonResponse($ers);
    //     }

    // }



   
}
