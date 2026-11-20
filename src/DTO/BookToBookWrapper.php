<?php

namespace App\DTO;

use App\Entity\Book;
use App\DTO\BookListDto;

final class BookToBookWrapper
{
    public static function wrapBookToBookListDTO(Book $book): BookListDto
    {
        return new BookListDto(
            $book->getId(),
            $book->getTitle(),
            $book->getAuthor(),
            $book->getPublishAt()
        );
    }
}