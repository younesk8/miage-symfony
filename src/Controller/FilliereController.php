<?php

namespace App\Controller;

use App\Entity\Filliere;
use App\Form\FilliereType;
use App\Repository\FilliereRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/filliere")
 */
class FilliereController extends AbstractController
{
    /**
     * @Route("/", name="filliere_index", methods={"GET"})
     */
    public function index(FilliereRepository $filliereRepository): Response
    {
        return $this->render('filliere/index.html.twig', [
            'fillieres' => $filliereRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="filliere_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $filliere = new Filliere();
        $form = $this->createForm(FilliereType::class, $filliere);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($filliere);
            $entityManager->flush();

            return $this->redirectToRoute('filliere_index');
        }

        return $this->render('filliere/new.html.twig', [
            'filliere' => $filliere,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="filliere_show", methods={"GET"})
     */
    public function show(Filliere $filliere): Response
    {
        return $this->render('filliere/show.html.twig', [
            'filliere' => $filliere,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="filliere_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Filliere $filliere): Response
    {
        $form = $this->createForm(FilliereType::class, $filliere);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('filliere_index');
        }

        return $this->render('filliere/edit.html.twig', [
            'filliere' => $filliere,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="filliere_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Filliere $filliere): Response
    {
        if ($this->isCsrfTokenValid('delete'.$filliere->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($filliere);
            $entityManager->flush();
        }

        return $this->redirectToRoute('filliere_index');
    }
}
