<?php

namespace App\Service;


use App\Entity\Book;
use App\Repository\BookRepository;
use Doctrine\ORM\EntityManagerInterface;

class BookService
{
    public function __construct(
        private BookRepository $bookRepository,
        private EntityManagerInterface $em
    ){}
    
    public function getBook(): array
    {
        return $this->bookRepository->findAll() ?? [];
    }

    public function getBookById(int $id): ?Book
    {
        return $this->bookRepository->find($id);
    }

    public function getBooksByTitle(string $title) : array
    {
        return $this->bookRepository->findByTitle($title);
    }

    public function getBooksByDate(string $date) : array
    {
        $date = new \DateTimeImmutable($date);
        return $this->bookRepository->findByDate($date);
    }

    public function getBooksByCategory(string $category) : array
    {
        return $this->bookRepository->findByCategory($category);
    }

    public function saveBook(Book $book): void
    {
        $this->em->persist($book);
        $this->em->flush();

    }
}