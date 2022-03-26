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

class OngletsController extends AbstractController
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
     * @Route("/massagem", name="massagem")
     */
    public function onglet1(PagesRepository $pagesRepo, ImagesService $imagesService, ContenuPageService $contenuPage): Response
    {
        if($this->is_debug){
            dump($this->is_debug);
            $this->logger->notice('Debug mode activated');
        }
        
        $pages = $pagesRepo->findAll();
        $images = $imagesService->getContenuHeader("accueil","highlights");
        $pageHeader = $contenuPage->getHeader(122, 3);
        
        return $this->render('onglet1/index.html.twig', [
            'pages' => $pages,
            'images' => $images,
            'header' => $pageHeader,
            'controller_name' => 'OngletsController',
        ]);
    }

    /**
     * @Route("/oleosessenciais", name="oleosessenciais")
     */
    public function onglet2(PagesRepository $pagesRepo, ImagesService $imagesService, ContenuPageService $contenuPage): Response
    {
        $pages = $pagesRepo->findAll();
        $images = $imagesService->getContenuHeader("accueil","highlights");
        $pageHeader = $contenuPage->getHeader(122, 3);
        
        
        return $this->render('onglet2/index.html.twig', [
            'pages' => $pages,
            'images' => $images,
            'header' => $pageHeader,
            'controller_name' => 'OngletsController',
        ]);
    }


    /**
     * @Route("/produtos/detalhe/{id}", name="detalhe_produto")
     */
    public function detail(ProdutosRepository $repo, PagesRepository $pagesRepo, ImagesRepository $imagesRepo, Produtos $produto): Response
    {
        $produtos = $repo->findAll();
        $pages = $pagesRepo->findAll();
        $images = $imagesRepo->findByPageBlock("accueil","highlights");
        
        return $this->render('produtos/detail.html.twig', [
            'controller_name' => 'ProdutosController',
            'produtos' => $produtos,
            'produto' => $produto,
            'pages' => $pages,
            'images' => $images,
        ]);
    }

    
}
