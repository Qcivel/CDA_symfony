<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CdaController
{
    #[Route('/cda', name: 'app_cda_index')]
    public function index(): Response
    {
        return new Response("Un petit texte");
    }
}