<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/user', name: 'user')]
    public function index(Request $request): Response
    {
        $em =  $this->getDoctrine()->getManager();
        $users = $em->getRepository(User::class)->findAll();

        $form = $this -> createForm(UserType::class, null, ['userList' => $users]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            dump($form->getData());
            $em->flush();
        }

        return $this->render('index.html.twig', array(
            'last_username' => 'a',
            'all_collections' => 'a',
            'form' => $form->createView(),
        ));
    }
}
