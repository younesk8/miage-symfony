<?php

namespace App\Controller;

use ApiPlatform\Core\Validator\ValidatorInterface;
use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;
use Symfony\Component\Serializer\Normalizer\NormalizableInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * @Route("/user")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/", name="user_index", methods={"GET"})
     */
    public function index(UserRepository $userRepository)
    {
        $users = $userRepository->findAll();
        //$userNormalises = $normalizer->serialize($users,"json", ['groups'=>'user:read']);
        //$json = json_encode($userNormalises);
        //$json = $normalizer->serialize($users,"json", ['groups'=>'user:read']);


        /*$response = new Response($json, 200, [
            "Content-Type" => "application/json"
        ] );*/
        //$response= new JsonResponse($json,200,[],true);
        $response=$this->json($users, 200,[], ["groups"=>"user:read"]);

        return $response;
    }

    /**
     * @Route("/new", name="user_new", methods={"POST"})
     */
    public function new(Request $request, SerializerInterface $serializer, EntityManager $manager,
    ValidatorInterface $validator): Response
    {
        $user = new User();
        $jsonRecu = $request->getContent();
        try {
            $users = $serializer ->deserialize($jsonRecu, User::class, 'json');
            $errors = $validator->validate($users);

            if (count($errors) > 0){
                return $this->json($errors, 400);
            }
            $manager->persist($users);
            $manager->flush();
            return $this->json($users, 201, [], ["groups"=>"user:read"]);
        }catch (NotEncodableValueException $e){
            return $this->json([
                "status"=>400,
                "message"=>$e->getMessage()
            ],400);
        }

        /*$form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('user_index');
        }

        return $this->render('user/new.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);*/
    }

    /**
     * @Route("/{id}", name="user_show", methods={"GET"})
     */
    public function show(User $user): Response
    {
        $response=$this->json($user, 200,[], ["groups"=>"user:read"]);

        return $response;
        /*return $this->render('user/show.html.twig', [
            'user' => $user,
        ]);*/
    }

    /**
     * @Route("/{id}/edit", name="user_edit", methods={"PUT"})
     */
    public function edit(Request $request, User $user,SerializerInterface $serializer, EntityManager $manager, ValidatorInterface $validator): Response
    {
        $jsonRecu = $request->getContent();
        $users = $serializer ->deserialize($jsonRecu, User::class, 'json');
        $errors = $validator->validate($users);

        if (count($errors) > 0){
            return $this->json($errors, 400);
        }

        $manager->flush();
        return $this->json($users, 202, [], ["groups"=>"user:read"]);

        /*$form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('user_index');
        }

        return $this->render('user/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);*/
    }

    /**
     * @Route("/{id}", name="user_delete", methods={"DELETE"})
     */
    public function delete(Request $request, User $user): Response
    {

        $response=$this->json($user, 200,[], ["groups"=>"user:read"]);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($user);
        $entityManager->flush();
        return $response;

        /*if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('user_index');*/
    }
}
