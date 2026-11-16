<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;


class UserController extends AbstractController
{
    
    public function profil(string $name): Response
    {
        
        return $this->render('user/profil.html.twig',[
            'name' => $name,
            'age' => 32,
            'city' =>'Toulouse',
        ]);
    }
}