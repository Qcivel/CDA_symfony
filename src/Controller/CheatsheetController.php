<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CheatsheetController extends AbstractController
{
    #[Route('/cheatsheet', name: 'app_cheatsheet')]
    public function index(): Response
    {
        return $this->render('cheatsheet/index.html.twig');
    }

    #[Route('/cheatsheet/setup', name: 'app_cheatsheet_setup', defaults: ['page' => 'setup'])]
    #[Route('/cheatsheet/controller', name: 'app_cheatsheet_controller', defaults: ['page' => 'controller'])]
    #[Route('/cheatsheet/entity', name: 'app_cheatsheet_entity', defaults: ['page' => 'entity'])]
    #[Route('/cheatsheet/tailwind', name: 'app_cheatsheet_tailwind', defaults: ['page' => 'tailwind'])]
    #[Route('/cheatsheet/components', name: 'app_cheatsheet_components', defaults: ['page' => 'components'])]
    #[Route('/cheatsheet/querybuilder', name: 'app_cheatsheet_querybuilder', defaults: ['page' => 'querybuilder'])]
    #[Route('/cheatsheet/params', name: 'app_cheatsheet_params', defaults: ['page' => 'params'])]
    #[Route('/cheatsheet/forms', name: 'app_cheatsheet_forms', defaults: ['page' => 'forms'])]
    #[Route('/cheatsheet/auth', name: 'app_cheatsheet_auth', defaults: ['page' => 'auth'])]
    public function show(string $page): Response
    {
        return $this->render('cheatsheet/'.$page.'.html.twig');
    }
}
