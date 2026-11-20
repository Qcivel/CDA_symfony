<?php

namespace App\Controller;

use App\Form\BookType;
use App\Service\BookService;
use BookToBookWrapper;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use App\Entity\Book;

class BookController extends AbstractController
{
    public function __construct(
        private BookService $bookService
    ){}

    #[Route(path:'/book', name: 'app_book')]
    #[IsGranted('ROLE_USER', message:'Vous n\'êtes pas autorisé  à accéder à la page')]
    public function showAllBook(): Response
    {
        $books = $this->bookService->getBook();

        return $this->render('book/show_all_book.html.twig',[
            'books' => $books
        ]);
    }
    #[Route(path:'/book/{id}',requirements: ['id' => '\d+'], name: 'app_book_id')]
    #[IsGranted('ROLE_USER', message:'Vous n\'êtes pas autorisé  à accéder à la page')]
    public function showBookById(int $id)
    {
        $book = $this->bookService->getBookById($id);
        return $this->render('book/show_book_by_id.html.twig',[
            'book' => $book
        ]);
    }
    #[Route(path:'/books/search/{title}', name: 'app_book_search')]
    #[IsGranted('ROLE_USER', message:'Vous n\'êtes pas autorisé  à accéder à la page')]
    public function showBooksbyTitle(string $title) : Response
    {
        $book = $this->bookService->getBooksByTitle($title);

        return $this->render('book/show_all_book.html.twig',[
            "books" => $book 
        ]);
    }
    #[Route(path:'/books/recent/{date}', name:'app_book_recent')]
    #[IsGranted('ROLE_USER', message:'Vous n\'êtes pas autorisé  à accéder à la page')]
    public function showBookByDate(string $date) : Response
    {
        $book = $this->bookService->getBooksByDate($date);
        return $this->render('book/show_all_book.html.twig',[
            "books" => $book
        ]);
    }
    #[Route(path:'/books/category/{category}', name:'app_book_category')]
    #[IsGranted('ROLE_USER', message:'Vous n\'êtes pas autorisé  à accéder à la page')]
    public function showBooksByCategory(string $category) : Response
    {
        $category = $this->bookService->getBooksByCategory($category);
        return $this->render('book/show_all_book.html.twig',[
            "books" => $category
        ]);
    }

    // #[Route(path:'/books/dto', name:'app_book_dto')]
    // #[IsGranted('ROLE_USER', message:'Vous n\'êtes pas autorisé  à accéder à la page')]
    // public function showBookListDTO(): Response
    // {
    //     $book = $this->bookService->getBook();

    //     if($book) BookToBookWrapper::wrapBookToBookListDTO($book);

    //     return $this->render('book/show_book_dto.html.twig',[
    //         'books' => $books ?? null
    //     ]);
    // }

    #[Route(path:'/books/new', name:'app_book_new', methods:["GET", "POST"])]
    #[IsGranted('ROLE_USER', message:'Vous n\'êtes pas autorisé  à accéder à la page')]
    public function new(Request $request):Response
    {
        $book = new Book();

        $form = $this->createForm(BookType::class,$book);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            
            $msg = $this->bookService->saveBook($book);

            $this->addFlash('notice', $msg);

            return $this->redirectToRoute('app_book_new');
        }

        return $this->render('book/book_new.html.twig', [
            'form'=> $form
        ]);

    }


}