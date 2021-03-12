<?php

namespace App\Controller;

use App\Entity\DescriptionDiplome;
use App\Form\DescriptionDiplomeType;
use App\Repository\DescriptionDiplomeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/description/diplome")
 */
class DescriptionDiplomeController extends AbstractController
{
    /**
     * @Route("/", name="description_diplome_index", methods={"GET"})
     */
    public function index(DescriptionDiplomeRepository $descriptionDiplomeRepository): Response
    {
        return $this->render('description_diplome/index.html.twig', [
            'description_diplomes' => $descriptionDiplomeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="description_diplome_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $descriptionDiplome = new DescriptionDiplome();
        $form = $this->createForm(DescriptionDiplomeType::class, $descriptionDiplome);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($descriptionDiplome);
            $entityManager->flush();

            return $this->redirectToRoute('description_diplome_index');
        }

        return $this->render('description_diplome/new.html.twig', [
            'description_diplome' => $descriptionDiplome,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="description_diplome_show", methods={"GET"})
     */
    public function show(DescriptionDiplome $descriptionDiplome): Response
    {
        return $this->render('description_diplome/show.html.twig', [
            'description_diplome' => $descriptionDiplome,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="description_diplome_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, DescriptionDiplome $descriptionDiplome): Response
    {
        $form = $this->createForm(DescriptionDiplomeType::class, $descriptionDiplome);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('description_diplome_index');
        }

        return $this->render('description_diplome/edit.html.twig', [
            'description_diplome' => $descriptionDiplome,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="description_diplome_delete", methods={"DELETE"})
     */
    public function delete(Request $request, DescriptionDiplome $descriptionDiplome): Response
    {
        if ($this->isCsrfTokenValid('delete'.$descriptionDiplome->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($descriptionDiplome);
            $entityManager->flush();
        }

        return $this->redirectToRoute('description_diplome_index');
    }
}
