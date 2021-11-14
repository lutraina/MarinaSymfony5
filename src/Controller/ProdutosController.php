<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProdutosRepository;
use App\Repository\ImagesRepository;
use App\Repository\PagesRepository;
use App\Entity\Produtos;

class ProdutosController extends AbstractController
{
    /**
     * @Route("/produtos", name="produtos")
     */
    public function index(ProdutosRepository $repo, PagesRepository $pagesRepo, ImagesRepository $imagesRepo): Response
    {
        $produtos = $repo->findAll();
        $pages = $pagesRepo->findAll();
        $images = $imagesRepo->findByPageBlock("accueil","highlights");
        
        return $this->render('produtos/index.html.twig', [
            'controller_name' => 'ProdutosController',
            'produtos' => $produtos,
            'pages' => $pages,
            'images' => $images,
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
