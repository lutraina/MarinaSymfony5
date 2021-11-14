<?php

namespace App\Controller\Admin;

use App\Entity\Categorias;
use App\Form\Categorias1Type;
use App\Repository\CategoriasRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/categorias")
 */
class AdminCategoriasController extends AbstractController
{
    /**
     * @Route("/", name="admin_categorias_index", methods={"GET"})
     */
    public function index(CategoriasRepository $categoriasRepository): Response
    {
        return $this->render('admin/admin_categorias/index.html.twig', [
            'categorias' => $categoriasRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="admin_categorias_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $categoria = new Categorias();
        $form = $this->createForm(Categorias1Type::class, $categoria);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($categoria);
            $entityManager->flush();

            return $this->redirectToRoute('admin_categorias_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/admin_categorias/new.html.twig', [
            'categoria' => $categoria,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="admin_categorias_show", methods={"GET"})
     */
    public function show(Categorias $categoria): Response
    {
        return $this->render('admin/admin_categorias/show.html.twig', [
            'categoria' => $categoria,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin_categorias_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Categorias $categoria): Response
    {
        $form = $this->createForm(Categorias1Type::class, $categoria);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_categorias_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/admin_categorias/edit.html.twig', [
            'categoria' => $categoria,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="admin_categorias_delete", methods={"POST"})
     */
    public function delete(Request $request, Categorias $categoria): Response
    {
        if ($this->isCsrfTokenValid('delete'.$categoria->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($categoria);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_categorias_index', [], Response::HTTP_SEE_OTHER);
    }
}
