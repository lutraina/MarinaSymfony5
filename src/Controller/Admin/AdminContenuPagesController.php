<?php

namespace App\Controller\Admin;

use App\Entity\ContenuPages;
use App\Form\ContenuPagesType;
use App\Repository\ContenuPagesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/contenu/pages")
 */
class AdminContenuPagesController extends AbstractController
{
    /**
     * @Route("/", name="admin_contenu_pages_index", methods={"GET"})
     */
    public function index(ContenuPagesRepository $contenuPagesRepository): Response
    {
        return $this->render('admin/admin_contenu_pages/index.html.twig', [
            'contenu_pages' => $contenuPagesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="admin_contenu_pages_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $contenuPage = new ContenuPages();
        $form = $this->createForm(ContenuPagesType::class, $contenuPage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($contenuPage);
            $entityManager->flush();

            return $this->redirectToRoute('admin/admin_contenu_pages_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/admin_contenu_pages/new.html.twig', [
            'contenu_page' => $contenuPage,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="admin_contenu_pages_show", methods={"GET"})
     */
    public function show(ContenuPages $contenuPage): Response
    {
        return $this->render('admin/admin_contenu_pages/show.html.twig', [
            'contenu_page' => $contenuPage,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin_contenu_pages_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, ContenuPages $contenuPage): Response
    {
        $form = $this->createForm(ContenuPagesType::class, $contenuPage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin/admin_contenu_pages_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/admin_contenu_pages/edit.html.twig', [
            'contenu_page' => $contenuPage,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="admin_contenu_pages_delete", methods={"POST"})
     */
    public function delete(Request $request, ContenuPages $contenuPage): Response
    {
        if ($this->isCsrfTokenValid('delete'.$contenuPage->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($contenuPage);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin/admin_contenu_pages_index', [], Response::HTTP_SEE_OTHER);
    }
}
