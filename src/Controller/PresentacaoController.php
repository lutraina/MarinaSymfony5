<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PresentacaoController extends AbstractController
{
    /**
     * @Route("/profissional", name="profissional")
     */
    public function index(): Response
    {
        return $this->render('presentacao/index.html.twig', [
            'controller_name' => 'PresentacaoController',
        ]);
    }
}
