<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;

class CdaController
{
    public function index(): Response
    {
        return new Response("Un petit texte");
    }
}