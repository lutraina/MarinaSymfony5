<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use App\Entity\ContenuPages;
use App\Entity\Pages;
use App\Repository\PagesRepository;
use App\Repository\ImagesRepository;
use App\Service\ContenuPageService;
use App\Service\ImagesService;
use Psr\Log\LoggerInterface;
use Sentry\State\HubInterface;

class AccueilController extends AbstractController
{
    const
    NOM_PAGE = 'home',
    SECTION_HEADER = 'header';
     
    private $is_debug; 
    private $is_online; 
    private $logger;
    
    
    public function __construct(bool $is_online, bool $is_debug, LoggerInterface $logger){
        $this->is_debug = $is_debug;
        $this->is_online = $is_online;
        $this->logger = $logger;
    }
    
    /**
     * @Route("/", name="home")
     */
    public function index(PagesRepository $pagesRepo, ImagesService $imagesService, ContenuPageService $contenuPage, HubInterface $sentryHub): Response
    {
        //dump($sentryHub);
        //throw new \Exception('test exception');
        
        if($this->is_debug){
            //dump($this->is_debug);
             $this->logger->notice('Debug mode activated');   
        }
        
        $pages = $pagesRepo->findAll();
        $images = $imagesService->getContenuHeader("accueil","highlights");
        $pageHeader = $contenuPage->getHeader(122, 3);
        
        return $this->render('home/index.html.twig', [
            'pages' => $pages,
            'images' => $images,
            'header' => $pageHeader,
            'controller_name' => 'AccueilController',
        ]);
    }
    
    /**
     * @Route("/blog/{id}", name="params")
     */
    public function show(Pages $page): Response
    {
        //ici on a un exemple de méthode qui prend la configuration de paramConverter automatiquement
        //the converter will find by the primary key
        dd($page);
    
    }
    
    ///**
   //  * @Route("/blog3/{post_id}", name="params2")
  //   * @ParamConverter("page", options={"mapping": {"id : "post_id"}})
   //  */
//public function show3(Pages $page): Response
 //   {
      //  dd($page);
//
   // }
    
   // /**
   //  * @Route("/blog4/{post_id}", name="params3")
   //  * @ParamConverter("page", options={"mapping": {"id : "post_id"}})
   //  */
   // public function show2(Pages $page): Response
    //{
    //    dd($page);
        
    //}
    
    
}