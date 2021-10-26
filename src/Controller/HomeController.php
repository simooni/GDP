<?php

namespace App\Controller;

use App\Entity\Taction;
use App\Entity\Nv1;

use App\Entity\Tdocument;



use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{

     /**
     * @Route("/home", name="home")
     * @Security("is_granted('ROLE_ADMIN')")
     */
    public function index(Request $request): Response
    {
        $arrayOfpageDocument = [];
        $arrayOfpageAction = [];
        

    

        $Nv1   =  $this->getDoctrine() ->getRepository(Nv1::class)->findAll();
        // $taction    =  $this->getDoctrine() ->getRepository(Taction::class)->findBy(array('suspendre'=>'0'),array('id' => 'desc'));
        $limit = 0;
        $category = null;
        $code = null;
        $id=0;
        $column='intitule';
        $order='asc';
        $id_dossier_document_plus=null;

        if(isset($_GET['id_dossier_doc_plus'])){
            $id_dossier_document_plus = $_GET['id_dossier_doc_plus'];
            $Tdocument   = $this->getDoctrine()->getRepository(Tdocument::class)
            ->findBy(array('suspondu'=>'0' , 'folder' => $id_dossier_document_plus));
            // dd($Tdocument);
            return $this->render('tableBody/plus_tdocument.html.twig', 
            [ 'Tdocument'=>$Tdocument  ]);

        }

        if(isset($_GET['code'])){
            $code = $_GET['code'];
        }
        else{
            $code = 'N1_1';
        }

        if(isset($_GET['limit'])){
            $limit = $_GET['limit'];
            $category = $_GET['category'];
        }

        if(isset($_GET['id'])){
            $id = $_GET['id'];
        }
        if(isset($_GET['column'])){
            $column = $_GET['column'];
        }
        if(isset($_GET['order'])){
            $order = $_GET['order'];
        }
        
        $Tdocument   = $this->getDoctrine()->getRepository(Tdocument::class)
                       ->findBy(array('suspondu'=>'0' , 'code_nv' => $code, 'folder'=>null),array($column => $order),15, $limit);
            
                  
                       
        $taction    =  $this->getDoctrine() ->getRepository(Taction::class)
                       ->findBy(array('suspendre'=>'0', 'code_nv' => $code, 'dossier' => null),array($column => $order),15, $limit);

        $Tdocument_Action   = $this->getDoctrine()->getRepository(Tdocument::class)
                        ->getDocumentHadAction($code);
                        // foreach($Tdocument_Action as $t){
                        //     if($t->getId()==398){
                        //         foreach($t->getTactions() as $b){
                        //             dump($b->getId());
                        //         }
                        //         die;
                        //     }
                        // }
        // dd($Tdocument);
        if($limit >= 0 && $category == 'document'){
            return $this->render('tableBody/tdocument.html.twig', 
                [ 'Tdocument'=>$Tdocument  ]
            );
            
        }
        elseif($limit >= 0 && $category == 'action') {
            return $this->render('tableBody/taction.html.twig', 
                [ 
                    'taction' =>  $taction,
                    'Tdocument_Action' => $Tdocument_Action
                ]
            );
        }

        // if($id >0){
        //     $Tdocument_action   = $this->getDoctrine()->getRepository(Tdocument::class)
        //     ->findBy(array('suspondu'=>'0' , 'id' => $id));
        //     // dd($Tdocument_action);
        //     return $this->render('tableBody/tdocument.html.twig', 
        //     [ 'Tdocument'=>$Tdocument_action  ]
        //     );

        // }



        if($category == null) {
            $TdocumentForPagination = $this->getDoctrine()->getRepository(Tdocument::class)->findBy(array('suspondu'=>'0', 'code_nv' => $code, 'folder'=>null));
            $numberOfRow = count($TdocumentForPagination);
            $recordPerPage = 15;
            $num = $numberOfRow/$recordPerPage;
            if(fmod($num, 1) !== 0.00){
                $numberOfpage = (int)($num + 1);
            } else {
                $numberOfpage = (int)($num);
            }
            
            //$val = '['. 1*10 .'-'. 2*10 .']';
            for($i = 0; $i < $numberOfpage; $i++) {
                $val = $i * $recordPerPage;
                array_push($arrayOfpageDocument, $val);  
            }
            $TdocumentForPagination = $this->getDoctrine()->getRepository(Taction::class)->findBy(array('suspendre'=>'0', 'code_nv' => $code, 'dossier' => null));
            $numberOfRow = count($TdocumentForPagination);
            $num = $numberOfRow/$recordPerPage;
            if(fmod($num, 1) !== 0.00){
                $numberOfpage = (int)($num + 1);
            } else {
                $numberOfpage = (int)($num);
            }
            // dd($taction);
            
            //$val = '['. 1*10 .'-'. 2*10 .']';
            for($i = 0; $i < $numberOfpage; $i++) {
                $val = $i * $recordPerPage;
                array_push($arrayOfpageAction, $val);  
            }

            

            if($id >0){
                $Tdocument_action1   = $this->getDoctrine()->getRepository(Tdocument::class)
                ->findBy(array('suspondu'=>'0' , 'id' => $id , 'code_nv' => $code));

                // dd($Tdocument_action);
                return $this->render('home/contenu_index.html.twig', 
                [   'Tdocument'=>$Tdocument_action1,
                    'Nv1' => $Nv1,
                    'taction' =>  $taction, 
                    'arrayOfpageAction' => $arrayOfpageAction, 
                    'arrayOfpageDocument' => $arrayOfpageDocument,
                    'code_niveau' => $_GET['code'],
                    'Tdocument_Action' => $Tdocument_Action  
                ]);
    
            }
            if(!isset($_GET['code'])){
                return $this->render('home/index.html.twig', [ 
                    'Nv1' => $Nv1,
                    'Tdocument'=>$Tdocument , 
                    'taction' =>  $taction, 
                    'arrayOfpageAction' => $arrayOfpageAction, 
                    'arrayOfpageDocument' => $arrayOfpageDocument,
                    'code_niveau' => $code,
                    'Tdocument_Action' => $Tdocument_Action
                ]);
            }
            else{
                return $this->render('home/contenu_index.html.twig', [ 
                    'Nv1' => $Nv1,
                    'Tdocument'=>$Tdocument , 
                    'taction' =>  $taction, 
                    'arrayOfpageAction' => $arrayOfpageAction, 
                    'arrayOfpageDocument' => $arrayOfpageDocument,
                    'code_niveau' => $_GET['code'],
                    'Tdocument_Action' => $Tdocument_Action
                ]);
            }
        }
        
       
    }

    /**
     * @Route("/", name="indexHome")
     */
    public function home()
    {
        return $this->redirectToRoute('home');
    }
   
    /**
     * @Route("/paginationdocument", name="paginationDocument")
     */
    public function paginationDocument(Request $request)
    {
         // Pagination Logic
         $TdocumentForPagination = $this->getDoctrine()->getRepository(Tdocument::class)->findBy(array('suspondu'=>'0'));
         $numberOfRow = count($TdocumentForPagination);
         $recordPerPage = 25;
         $num = $numberOfRow/$recordPerPage;
         if(fmod($num, 1) !== 0.00){
             $numberOfpage = (int)($num + 1);
         } else {
             $numberOfpage = (int)($num);
         }
         $arrayOfpage = [];
         //$val = '['. 1*10 .'-'. 2*10 .']';
         for($i = 0; $i < $numberOfpage; $i++) {
             $val = $i * $recordPerPage;
             array_push($arrayOfpage, $val);  
        }

        return new JsonResponse($arrayOfpage);
    }
    /**
     * @Route("/paginationaction", name="paginationAction")
     */
    public function paginationAction(Request $request)
    {
         // Pagination Logic
         $TdocumentForPagination = $this->getDoctrine()->getRepository(Taction::class)->findBy(array('suspendre'=>'0'));
         $numberOfRow = count($TdocumentForPagination);
         $recordPerPage = 25;
         $num = $numberOfRow/$recordPerPage;
         if(fmod($num, 1) !== 0.00){
             $numberOfpage = (int)($num + 1);
         } else {
             $numberOfpage = (int)($num);
         }
         $arrayOfpage = [];
         //$val = '['. 1*10 .'-'. 2*10 .']';
         for($i = 0; $i < $numberOfpage; $i++) {
             $val = $i * $recordPerPage;
             array_push($arrayOfpage, $val);  
        }
        return new JsonResponse($arrayOfpage);
    }

    /**
     * @Route("/filtrationDocument", name="filtrationDocument")
     */
    public function filtrationDocument(Request $request) {

        if(isset($_GET['intituleDocument']) && !isset($_GET['typeDocument'])) {
            $Tdocument   = $this->getDoctrine()->getRepository(Tdocument::class)->findByIntitule($_GET['intituleDocument'], $_GET['code']);
          
  
        }
        elseif(!isset($_GET['intituleDocument']) && isset($_GET['typeDocument'])) {
            $Tdocument   = $this->getDoctrine()->getRepository(Tdocument::class)->findByType($_GET['typeDocument'], $_GET['code']);
        }
        else {
            $Tdocument   = $this->getDoctrine()->getRepository(Tdocument::class)->findByIntituleType($_GET['intituleDocument'], $_GET['typeDocument'],$_GET['code']);                            
        }
        // dd($Tdocument);
        return $this->render('tableBody/tdocument.html.twig',[
            'Tdocument'=>$Tdocument  
        ]);
        
    }

    /**
     * @Route("/filtrationAction", name="filtrationAction")
     */
    public function filtrationAction(Request $request) {
        // , $_GET['code']
        if(isset($_GET['intituleAction']) && !isset($_GET['typeAction'])) {
            $taction = $this->getDoctrine()->getRepository(Taction::class)->findByIntitule($_GET['intituleAction'], $_GET['code']);
        }
        elseif(!isset($_GET['intituleAction']) && isset($_GET['typeAction'])) {
            $taction = $this->getDoctrine()->getRepository(Taction::class)->findByType($_GET['typeAction'], $_GET['code']);
        }
        else {
            $taction = $this->getDoctrine()->getRepository(Taction::class)->findByIntituleType($_GET['intituleAction'],$_GET['typeAction'], $_GET['code']);                  
        }
        return $this->render('tableBody/taction.html.twig', 
                [ 'taction' =>  $taction ]
        );
    
        
    }
    


  
}
