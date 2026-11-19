<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        $formations = [
        [
            'title' => 'Développement PHP',
            'description' => 'Découvrir le développement côté serveur.',
        ],
        [
            'title' => 'Symfony',
            'description' => 'Structurer une application web en PHP.',
        ],
        [
            'title' => 'Enregistrer en BDD',
            'description' => 'Enregistrer des données en bdd.'
        ],
        [
            'title' => 'Supprimer en BDD',
            'description' => 'Supprimer des données en bdd.'
        ],
        ];
        return $this->render('home/index.html.twig',[
            'formations' => $formations
        ]);
    }
}