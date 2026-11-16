<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class BookController extends AbstractController
{
    #[Route('/livres', name: 'app_book')]
    public function book()
    {
        $books = [
        ['id' => 1, 'title' => 'Dune', 'author' => 'Frank Herbert'],
        ['id' => 2, 'title' => '1984', 'author' => 'George Orwell'],
        ['id' => 3, 'title' => 'Fondation', 'author' => 'Isaac Asimov'],
    ];
        return $this->render('book/book.html.twig',[
            'book' => $books
        ]);
    }
}