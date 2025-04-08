<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;
use App\Models\Book;
use App\Rules\Isbn;
use App\Services\BookService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class BookController extends Controller
{
    public function __construct(
        protected BookService $bookService
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $perPage = $request->get('per_page', 12);
        $books = $this->bookService->paginate($perPage);

        return BookResource::collection($books);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): BookResource
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
    public function show(Book $book): BookResource
    {
        return new BookResource($book);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book): BookResource
    {
        $validated = $request->validate([
            'isbn' => ['sometimes', new Isbn(), 'unique:books,isbn'],
            'title' => 'sometimes|string',
            'authors' => 'sometimes|string',
            'publisher' => 'sometimes|nullable|string',
            'edition' => 'sometimes|nullable|string',
            'language' => 'sometimes|nullable|string',
            'publication_date' => 'sometimes|nullable|date|before:now',
            'image' => 'sometimes|nullable|string',
            'pages' => 'sometimes|nullable|integer',
            'description' => 'sometimes|nullable|string'
        ]);

        $updated = $this->bookService->update($book, $validated);

        return new BookResource($updated);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book): Response
    {
        $this->bookService->delete($book);

        return response()->noContent();
    }
}
