<?php

namespace App\Controller;

use App\Entity\InscriptionSemestre;
use App\Form\InscriptionSemestreType;
use App\Repository\InscriptionSemestreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/inscription/semestre")
 */
class InscriptionSemestreController extends AbstractController
{
    /**
     * @Route("/", name="inscription_semestre_index", methods={"GET"})
     */
    public function index(InscriptionSemestreRepository $inscriptionSemestreRepository): Response
    {
        return $this->render('inscription_semestre/index.html.twig', [
            'inscription_semestres' => $inscriptionSemestreRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="inscription_semestre_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $inscriptionSemestre = new InscriptionSemestre();
        $form = $this->createForm(InscriptionSemestreType::class, $inscriptionSemestre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($inscriptionSemestre);
            $entityManager->flush();

            return $this->redirectToRoute('inscription_semestre_index');
        }

        return $this->render('inscription_semestre/new.html.twig', [
            'inscription_semestre' => $inscriptionSemestre,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="inscription_semestre_show", methods={"GET"})
     */
    public function show(InscriptionSemestre $inscriptionSemestre): Response
    {
        return $this->render('inscription_semestre/show.html.twig', [
            'inscription_semestre' => $inscriptionSemestre,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="inscription_semestre_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, InscriptionSemestre $inscriptionSemestre): Response
    {
        $form = $this->createForm(InscriptionSemestreType::class, $inscriptionSemestre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('inscription_semestre_index');
        }

        return $this->render('inscription_semestre/edit.html.twig', [
            'inscription_semestre' => $inscriptionSemestre,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="inscription_semestre_delete", methods={"DELETE"})
     */
    public function delete(Request $request, InscriptionSemestre $inscriptionSemestre): Response
    {
        if ($this->isCsrfTokenValid('delete'.$inscriptionSemestre->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($inscriptionSemestre);
            $entityManager->flush();
        }

        return $this->redirectToRoute('inscription_semestre_index');
    }
}
