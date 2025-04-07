<?php

namespace App\Services;

use App\Models\Book;
use App\Repositories\BookRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

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
     * @return LengthAwarePaginator
     */
    public function paginate(int $perPage = 12): LengthAwarePaginator
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
}
