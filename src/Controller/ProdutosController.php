<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProdutosRepository;
use App\Service\ContenuPageService;
use App\Service\ImagesService;
use Psr\Log\LoggerInterface;
use App\Repository\PagesRepository;
use App\Entity\Produtos;
use App\Repository\ImagesRepository;

class ProdutosController extends AbstractController
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
     * @Route("/marinatraina", name="marinatraina")
     */
    public function index(ProdutosRepository $repo, PagesRepository $pagesRepo, ImagesService $imagesService, ContenuPageService $contenuPage): Response
    {
        $produtos = $repo->findAll();
        $pages = $pagesRepo->findAll();
        $images = $imagesService->getContenuHeader("accueil","highlights");
        $pageHeader = $contenuPage->getHeader(122, 3);
        
        return $this->render('produtos/index.html.twig', [
            'controller_name' => 'ProdutosController',
            'produtos' => $produtos,
            'pages' => $pages,
            'images' => $images,
            'header' => $pageHeader,
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
