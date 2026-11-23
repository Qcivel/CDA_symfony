<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use App\Service\UserService;
use App\Form\ProfileType;
use App\Entity\User;

class UserController extends AbstractController
{
    public function __construct(
        private UserService $userService
    ){}
    
    #[Route(path:'/user', name: 'app_users')]
    #[IsGranted('ROLE_ADMIN', message: 'Vous n\'êtes pas autorisé')]
    public function showUser(): Response
    {
        $users = $this->userService->getUsers();

        return $this->render('user/show_all_user.html.twig',[
            'users' => $users
        ]);
    }

    //Page utilisateur
    #[Route(path:'/profil', name: 'app_profil')]
    #[IsGranted('ROLE_USER', message: 'Vous n\'êtes pas autorisé')]
    public function profil(): Response
    {
        $user = $this->getUser();

        return $this->render('user/show_user_by_id.html.twig',[
            'user' => $user
        ]);
    }


    #[Route(path:'/user/{id}', name: 'app_user_id')]
    public function showUserById(int $id) 
    {
        $user = $this->userService->getUserById($id);
        return $this->render('user/show_user_by_id.html.twig',[
            'user' => $user

        ]);
    }
    #[Route(path:'/user/{id}/edit', name: 'app_user_edit', methods:["GET", "POST"])]
    #[IsGranted('ROLE_USER', message: 'Vous n\'êtes pas autorisé')]
    public function edit(Request $request, int $id): Response
    {
        $user = $this->userService->getUserById($id);

        if (!$user) {
            throw $this->createNotFoundException('Le livre n\'existe pas');
        }

        $form = $this->createForm(ProfileType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $msg = $this->userService->edituser($user);
            $this->addFlash('notice', $msg);

            return $this->redirectToRoute('app_users');
        }

        return $this->render('user/user_edit.html.twig', [
            'form' => $form
        ]);
    }
}   