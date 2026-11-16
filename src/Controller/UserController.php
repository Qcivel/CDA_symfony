<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class UserController extends AbstractController
{
    #[Route('/profil/{name}', name: 'app_profil')]
    public function profil(string $name): Response
    {
        
        return $this->render('user/profil.html.twig',[
            'name' => $name,
            'age' => 32,
            'city' =>'Toulouse',
        ]);
    }
}