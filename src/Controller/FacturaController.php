<?php

namespace App\Controller;

use App\Entity\Imagen;
use App\Form\ImagenType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/imagen")
 */
class FacturaController extends AbstractController
{
    /**
     * @Route("/", name="factura_index", methods={"GET"})
     */
    public function index(): Response
    {
        $facturas = $this->getDoctrine()
            ->getRepository(Imagen::class)
            ->findAll();

        return $this->render('factura/index.html.twig', [
            'facturas' => $facturas,
        ]);
    }

    /**
     * @Route("/new", name="factura_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $factura = new Imagen();
        $form = $this->createForm(ImagenType::class, $factura);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($factura);
            $entityManager->flush();

            return $this->redirectToRoute('factura_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('factura/new.html.twig', [
            'factura' => $factura,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{item}", name="factura_show", methods={"GET"})
     */
    public function show(Imagen $factura): Response
    {
        return $this->render('factura/show.html.twig', [
            'factura' => $factura,
        ]);
    }

    /**
     * @Route("/{item}/edit", name="factura_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Imagen $factura): Response
    {
        $form = $this->createForm(ImagenType::class, $factura);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('factura_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('factura/edit.html.twig', [
            'factura' => $factura,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{item}", name="factura_delete", methods={"POST"})
     */
    public function delete(Request $request, Imagen $factura): Response
    {
        if ($this->isCsrfTokenValid('delete'.$factura->getItem(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($factura);
            $entityManager->flush();
        }

        return $this->redirectToRoute('factura_index', [], Response::HTTP_SEE_OTHER);
    }
}
