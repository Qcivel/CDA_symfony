<?php

namespace App\Controller;

use App\Service\BookService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;

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
    #[Route(path:'/books/search/{title}', name: 'app_book_search')]
    public function showBooksbyTitle(string $title) : Response
    {
        $book = $this->bookService->getBooksByTitle($title);

        return $this->render('book/show_all_book.html.twig',[
            "books" => $book 
        ]);
    }
    #[Route(path:'/books/recent/{date}', name:'app_book_recent')]
    public function showBookByDate(string $date) : Response
    {
        $book = $this->bookService->getBooksByDate($date);
        return $this->render('book/show_all_book.html.twig',[
            "books" => $book
        ]);
    }
    #[Route(path:'/books/category/{category}', name:'app_book_category')]
    public function showBooksByCategory(string $category) : Response
    {
        $category = $this->bookService->getBooksByCategory($category);
        return $this->render('book/show_all_book.html.twig',[
            "books" => $category
        ]);
    }




}