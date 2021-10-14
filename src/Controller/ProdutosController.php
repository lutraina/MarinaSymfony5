<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProdutosController extends AbstractController
{
    /**
     * @Route("/produtos", name="produtos")
     */
    public function index(): Response
    {
        return $this->render('produtos/index.html.twig', [
            'controller_name' => 'ProdutosController',
        ]);
    }
}
