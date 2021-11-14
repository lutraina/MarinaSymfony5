<?php

namespace App\Controller\Admin;

use App\Entity\Pages;
use App\Form\Pages1Type;
use App\Repository\PagesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/pages")
 */
class AdminPagesController extends AbstractController
{
    /**
     * @Route("/", name="admin_pages_index", methods={"GET"})
     */
    public function index(PagesRepository $pagesRepository): Response
    {
        return $this->render('admin/admin_pages/index.html.twig', [
            'pages' => $pagesRepository->findAll(),
            'contenu' => 'headercontenu a changer',
        ]);
    }

    /**
     * @Route("/new", name="admin_pages_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $page = new Pages();
        $form = $this->createForm(Pages1Type::class, $page);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($page);
            $entityManager->flush();

            return $this->redirectToRoute('admin_pages_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/admin_pages/new.html.twig', [
            'page' => $page,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="admin_pages_show", methods={"GET"})
     */
    public function show(Pages $page): Response
    {
        return $this->render('admin/admin_pages/show.html.twig', [
            'page' => $page,
            'contenu' => 'headercontenu a changer',
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin_pages_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Pages $page): Response
    {
        $form = $this->createForm(Pages1Type::class, $page);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_pages_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/admin_pages/edit.html.twig', [
            'page' => $page,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="admin_pages_delete", methods={"POST"})
     */
    public function delete(Request $request, Pages $page): Response
    {
        if ($this->isCsrfTokenValid('delete'.$page->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($page);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_pages_index', [], Response::HTTP_SEE_OTHER);
    }
}
