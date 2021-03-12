<?php

namespace App\Controller;

use App\Entity\UserSemestre;
use App\Form\UserSemestreType;
use App\Repository\UserSemestreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/user/semestre")
 */
class UserSemestreController extends AbstractController
{
    /**
     * @Route("/", name="user_semestre_index", methods={"GET"})
     */
    public function index(UserSemestreRepository $userSemestreRepository): Response
    {
        return $this->render('user_semestre/index.html.twig', [
            'user_semestres' => $userSemestreRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="user_semestre_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $userSemestre = new UserSemestre();
        $form = $this->createForm(UserSemestreType::class, $userSemestre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($userSemestre);
            $entityManager->flush();

            return $this->redirectToRoute('user_semestre_index');
        }

        return $this->render('user_semestre/new.html.twig', [
            'user_semestre' => $userSemestre,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="user_semestre_show", methods={"GET"})
     */
    public function show(UserSemestre $userSemestre): Response
    {
        return $this->render('user_semestre/show.html.twig', [
            'user_semestre' => $userSemestre,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="user_semestre_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, UserSemestre $userSemestre): Response
    {
        $form = $this->createForm(UserSemestreType::class, $userSemestre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('user_semestre_index');
        }

        return $this->render('user_semestre/edit.html.twig', [
            'user_semestre' => $userSemestre,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="user_semestre_delete", methods={"DELETE"})
     */
    public function delete(Request $request, UserSemestre $userSemestre): Response
    {
        if ($this->isCsrfTokenValid('delete'.$userSemestre->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($userSemestre);
            $entityManager->flush();
        }

        return $this->redirectToRoute('user_semestre_index');
    }
}
