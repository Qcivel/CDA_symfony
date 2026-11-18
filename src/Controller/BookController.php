<?php

namespace App\Controller;

use App\Service\BookService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


class BookController extends AbstractController
{
    public function __construct(
        private BookService $bookService
    ){}

    #[Route(path:'/book', name: 'app_book')]
    public function showAllBook(): Response
    {
        $books = $this->bookService->getBook();

        return $this->render('book/show_all_book.html.twig',[
            'books' => $books
        ]);
    }
    #[Route(path:'/book/{id}',requirements: ['id' => '\d+'], name: 'app_book_id')]
    public function showBookById(int $id)
    {
        $book = $this->bookService->getBookById($id);
        return $this->render('book/show_book_by_id.html.twig',[
            'book' => $book
        ]);
    }
}