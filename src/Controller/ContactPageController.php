<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\ContenuPages;
use App\Entity\Pages;
use App\Repository\PagesRepository;
use App\Repository\ImagesRepository;
use App\Service\ContenuPageService;
use App\Service\ImagesService;
use Psr\Log\LoggerInterface;


class ContactPageController extends AbstractController
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
     * @Route("/contato", name="contato")
     */
    public function index(PagesRepository $pagesRepo, ImagesService $imagesService, ContenuPageService $contenuPage): Response
    {
        if($this->is_debug){
            dump($this->is_debug);
            $this->logger->notice('Debug mode activated');
        }
        
        $pages = $pagesRepo->findAll();
        $images = $imagesService->getContenuHeader("accueil","highlights");
        $pageHeader = $contenuPage->getHeader(122, 3);
        
        return $this->render('contact_page/index.html.twig', [
            'pages' => $pages,
            'images' => $images,
            'header' => $pageHeader,
            'controller_name' => 'ContactPageController',
        ]);
    }
}
