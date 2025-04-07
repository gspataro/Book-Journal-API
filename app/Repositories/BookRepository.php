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
}
