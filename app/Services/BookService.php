<?php

namespace App\Services;

use App\Models\Book;
use App\Repositories\BookRepository;
use Illuminate\Contracts\Pagination\Paginator;

class BookService
{
    public function __construct(
        protected BookRepository $repository
    ) {
    }

    /**
     * Paginate books
     *
     * @param integer $perPage
     * @return Paginator<int, \App\Models\Book>
     */
    public function paginate(int $perPage = 12): Paginator
    {
        return $this->repository->paginate($perPage);
    }

    /**
     * Create a book
     *
     * @param array<mixed> $data
     * @return Book
     */
    public function create(array $data): Book
    {
        return $this->repository->create($data);
    }

    /**
     * Update a book
     *
     * @param Book $book
     * @param array<mixed> $data
     * @return Book
     */
    public function update(Book $book, array $data): Book
    {
        return $this->repository->update($book, $data);
    }

    /**
     * Delete a book
     *
     * @param Book $book
     * @return bool
     */
    public function delete(Book $book): bool
    {
        return $this->repository->delete($book);
    }
}
