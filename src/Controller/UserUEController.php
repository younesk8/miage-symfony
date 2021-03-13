<?php

namespace App\Controller;

use App\Entity\UserUE;
use App\Form\UserUEType;
use App\Repository\UserUERepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/user/u/e")
 */
class UserUEController extends AbstractController
{
    /**
     * @Route("/", name="user_u_e_index", methods={"GET"})
     */
    public function index(UserUERepository $userUERepository): Response
    {
        return $this->render('user_ue/index.html.twig', [
            'user_u_es' => $userUERepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="user_u_e_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $userUE = new UserUE();
        $form = $this->createForm(UserUEType::class, $userUE);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($userUE);
            $entityManager->flush();

            return $this->redirectToRoute('user_u_e_index');
        }

        return $this->render('user_ue/new.html.twig', [
            'user_u_e' => $userUE,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="user_u_e_show", methods={"GET"})
     */
    public function show(UserUE $userUE): Response
    {
        return $this->render('user_ue/show.html.twig', [
            'user_u_e' => $userUE,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="user_u_e_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, UserUE $userUE): Response
    {
        $form = $this->createForm(UserUEType::class, $userUE);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('user_u_e_index');
        }

        return $this->render('user_ue/edit.html.twig', [
            'user_u_e' => $userUE,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="user_u_e_delete", methods={"DELETE"})
     */
    public function delete(Request $request, UserUE $userUE): Response
    {
        if ($this->isCsrfTokenValid('delete'.$userUE->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($userUE);
            $entityManager->flush();
        }

        return $this->redirectToRoute('user_u_e_index');
    }
}
