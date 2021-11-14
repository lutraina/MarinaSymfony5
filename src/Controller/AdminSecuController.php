<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Pages;
use App\Repository\PagesRepository;
use App\Form\InscriptionType;
use App\Entity\Utilisateur;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class AdminSecuController extends AbstractController
{
    /**
     * @Route("/inscription", name="inscription")
     */
    public function index(PagesRepository $pagesRepo, Request $request, EntityManagerInterface $om, UserPasswordEncoderInterface $encoder): Response
    {
        $pages = $pagesRepo->findAll();
        
        $utilisateur = new Utilisateur();
        $form = $this->createForm(InscriptionType::class, $utilisateur);
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            
            $utilisateur->setPassword($encoder->encodePassword($utilisateur, $utilisateur->getPassword()));
            
            $om->persist($utilisateur);
            $om->flush();
            //return $this->redirectToRoute('home');
        }
        
        return $this->render('admin_secu/inscription.html.twig', [
            'controller_name' => 'AdminSecuController',
            'form' => $form->createView(),
            //'pages' => $pages,
        ]);
    }
    
    
    /**
     * @Route("/login", name="connexion")
     */
    public function login(AuthenticationUtils $authUtil){
        
        return $this->render("admin_secu/login.html.twig", [
            "lastUserName" => $authUtil->getLastUsername(),
            "error" => $authUtil->getLastAuthenticationError()
        ]);
    }
    
    /**
     * @Route("/logout", name="logout")
     */
    public function logout(AuthenticationUtils $authUtil){
        
        throw new \Exception('logout() shoud never be reached');
    }
    
    
    
    
}
