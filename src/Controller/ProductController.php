<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProductController extends AbstractController
{
    #[Route('/produit/{id}', name: 'app_product')]
    public function show(int $id): Response
    {
        if (filter_var($id, FILTER_VALIDATE_INT)){
            return $this->render('product/product.html.twig', [
                'id' => $id
            ]);
        }else{
            return new Response("Erreur HTTP 404");
        }
    }
}