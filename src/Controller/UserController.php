<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Service\UserService;

class UserController extends AbstractController
{
    public function __construct(
        private UserService $userService
    ){}
    
    #[Route(path:'/user', name: 'app_users')]
    public function showUser(): Response
    {
        $users = $this->userService->getUsers();

        return $this->render('user/show_all_user.html.twig',[
            'users' => $users
        ]);
    }

    #[Route(path:'/user/{id}', name: 'app_user')]
    public function showUserById(int $id) 
    {
        $user = $this->userService->getUserById($id);
        return $this->render('user/show_user_by_id.html.twig',[
            'user' => $user

        ]);
    }
}   