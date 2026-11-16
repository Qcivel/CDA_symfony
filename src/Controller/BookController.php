<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


class BookController extends AbstractController
{
    private array $books = [
        ['id' => 1, 'title' => 'Dune', 'author' => 'Frank Herbert'],
        ['id' => 2, 'title' => '1984', 'author' => 'George Orwell'],
        ['id' => 3, 'title' => 'Fondation', 'author' => 'Isaac Asimov'],
    ];

    #[Route('/livres', name: 'app_book')]
    public function book()
    {
        return $this->render('book/book.html.twig',[
            'book' => $this->books
        ]);
    }
    #[Route('/livres/{id}', requirements:['id' => '\d+'], name: 'app_show')]
    public function show(int $id) 
    {
        if($id > count($this->books) || $id == null){
            throw $this->createNotFoundException('Livre introuvable');
        }else{
            $show_book = array_find($this->books, fn($value) => $value['id'] === $id);
            return $this->render('book/show.html.twig', [
                'show_book' => $show_book
            ]);
        }
    }
}