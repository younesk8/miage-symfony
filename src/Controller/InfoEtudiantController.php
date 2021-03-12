<?php

namespace App\Controller;

use App\Entity\InfoEtudiant;
use App\Form\InfoEtudiantType;
use App\Repository\InfoEtudiantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/info/etudiant")
 */
class InfoEtudiantController extends AbstractController
{
    /**
     * @Route("/", name="info_etudiant_index", methods={"GET"})
     */
    public function index(InfoEtudiantRepository $infoEtudiantRepository): Response
    {
        return $this->render('info_etudiant/index.html.twig', [
            'info_etudiants' => $infoEtudiantRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="info_etudiant_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $infoEtudiant = new InfoEtudiant();
        $form = $this->createForm(InfoEtudiantType::class, $infoEtudiant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($infoEtudiant);
            $entityManager->flush();

            return $this->redirectToRoute('info_etudiant_index');
        }

        return $this->render('info_etudiant/new.html.twig', [
            'info_etudiant' => $infoEtudiant,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="info_etudiant_show", methods={"GET"})
     */
    public function show(InfoEtudiant $infoEtudiant): Response
    {
        return $this->render('info_etudiant/show.html.twig', [
            'info_etudiant' => $infoEtudiant,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="info_etudiant_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, InfoEtudiant $infoEtudiant): Response
    {
        $form = $this->createForm(InfoEtudiantType::class, $infoEtudiant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('info_etudiant_index');
        }

        return $this->render('info_etudiant/edit.html.twig', [
            'info_etudiant' => $infoEtudiant,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="info_etudiant_delete", methods={"DELETE"})
     */
    public function delete(Request $request, InfoEtudiant $infoEtudiant): Response
    {
        if ($this->isCsrfTokenValid('delete'.$infoEtudiant->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($infoEtudiant);
            $entityManager->flush();
        }

        return $this->redirectToRoute('info_etudiant_index');
    }
}
