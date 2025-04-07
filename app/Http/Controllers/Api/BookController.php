<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;
use App\Models\Book;
use App\Rules\Isbn;
use App\Services\BookService;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function __construct(
        protected BookService $bookService
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 12);
        $books = $this->bookService->paginate($perPage);

        return new BookResource($books);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // @todo Modify this implementation to integrate external ISBN API
        $validated = $request->validate([
            'isbn' => ['required', new Isbn(), 'unique:books,isbn'],
            'title' => 'required|string',
            'authors' => 'required|string',
            'publisher' => 'nullable|string',
            'edition' => 'nullable|string',
            'language' => 'nullable|string',
            'publication_date' => 'nullable|date|before:now',
            'image' => 'nullable|string',
            'pages' => 'nullable|integer',
            'description' => 'nullable|string'
        ]);
        $book = $this->bookService->create($validated);

        return new BookResource($book);
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        return new BookResource($book);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
