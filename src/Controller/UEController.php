<?php

namespace App\Controller;

use App\Entity\UE;
use App\Form\UEType;
use App\Repository\UERepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/u/e")
 */
class UEController extends AbstractController
{
    /**
     * @Route("/", name="u_e_index", methods={"GET"})
     */
    public function index(UERepository $uERepository): Response
    {
        return $this->render('ue/index.html.twig', [
            'u_es' => $uERepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="u_e_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $uE = new UE();
        $form = $this->createForm(UEType::class, $uE);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($uE);
            $entityManager->flush();

            return $this->redirectToRoute('u_e_index');
        }

        return $this->render('ue/new.html.twig', [
            'u_e' => $uE,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="u_e_show", methods={"GET"})
     */
    public function show(UE $uE): Response
    {
        return $this->render('ue/show.html.twig', [
            'u_e' => $uE,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="u_e_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, UE $uE): Response
    {
        $form = $this->createForm(UEType::class, $uE);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('u_e_index');
        }

        return $this->render('ue/edit.html.twig', [
            'u_e' => $uE,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="u_e_delete", methods={"DELETE"})
     */
    public function delete(Request $request, UE $uE): Response
    {
        if ($this->isCsrfTokenValid('delete'.$uE->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($uE);
            $entityManager->flush();
        }

        return $this->redirectToRoute('u_e_index');
    }
}
