<?php

namespace App\Repositories;

use App\Models\Book;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class BookRepository
{
    /**
     * Paginate books
     *
     * @param integer $perPage
     * @return LengthAwarePaginator
     */
    public function paginate(int $perPage = 12): LengthAwarePaginator
    {
        return Book::paginate($perPage);
    }

    /**
     * Create a book
     *
     * @param array<mixed> $data
     * @return Book
     */
    public function create(array $data): Book
    {
        return Book::create($data);
    }

    /**
     * Edit a book
     *
     * @param Book $book
     * @param array<mixed> $data
     * @return Book
     */
    public function update(Book $book, array $data): Book
    {
        $book->update($data);

        return $book;
    }
}
