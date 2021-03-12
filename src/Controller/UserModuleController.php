<?php

namespace App\Controller;

use App\Entity\UserModule;
use App\Form\UserModuleType;
use App\Repository\UserModuleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/user/module")
 */
class UserModuleController extends AbstractController
{
    /**
     * @Route("/", name="user_module_index", methods={"GET"})
     */
    public function index(UserModuleRepository $userModuleRepository): Response
    {
        return $this->render('user_module/index.html.twig', [
            'user_modules' => $userModuleRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="user_module_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $userModule = new UserModule();
        $form = $this->createForm(UserModuleType::class, $userModule);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($userModule);
            $entityManager->flush();

            return $this->redirectToRoute('user_module_index');
        }

        return $this->render('user_module/new.html.twig', [
            'user_module' => $userModule,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="user_module_show", methods={"GET"})
     */
    public function show(UserModule $userModule): Response
    {
        return $this->render('user_module/show.html.twig', [
            'user_module' => $userModule,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="user_module_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, UserModule $userModule): Response
    {
        $form = $this->createForm(UserModuleType::class, $userModule);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('user_module_index');
        }

        return $this->render('user_module/edit.html.twig', [
            'user_module' => $userModule,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="user_module_delete", methods={"DELETE"})
     */
    public function delete(Request $request, UserModule $userModule): Response
    {
        if ($this->isCsrfTokenValid('delete'.$userModule->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($userModule);
            $entityManager->flush();
        }

        return $this->redirectToRoute('user_module_index');
    }
}
