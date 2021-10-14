<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MetodologiaController extends AbstractController
{
    /**
     * @Route("/metodologia", name="metodologia")
     */
    public function index(): Response
    {
        return $this->render('metodologia/index.html.twig', [
            'controller_name' => 'MetodologiaController',
        ]);
    }
}
