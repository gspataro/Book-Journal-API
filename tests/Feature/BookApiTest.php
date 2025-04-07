<?php

use App\Models\Book;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;

uses(RefreshDatabase::class);

pest()->beforeEach(function () {
    Sanctum::actingAs(
        User::factory()->create()
    );
});

describe('book:index', function () {
    it('lists books', function () {
        Book::factory()->count(12)->create();
        $response = $this->getJson('/api/book');

        $response->assertOk()->assertJsonCount(12, 'data');
    });

    it('paginates books', function () {
        Book::factory()->count(15)->create();

        $response = $this->json('GET', '/api/book', [
            'page' => 2
        ]);

        $response->assertOk()->assertJsonCount(3, 'data');
    });
});

describe('book:store', function () {
    it('creates a book', function () {
        $book = Book::factory()->make();
        $response = $this->postJson('/api/book', $book->toArray());

        $response->assertStatus(201);
        $this->assertDatabaseHas('books', [
            'isbn' => $book->isbn
        ]);
    });

    it('prevents isbn duplicates', function () {
        $book = Book::factory()->create();
        $newBook = Book::factory()->make([
            'isbn' => $book->isbn
        ]);

        $response = $this->postJson('/api/book', $newBook->toArray());

        $response->assertStatus(422);
    });
});

describe('book:show', function () {
    it('shows a book', function () {
        $book = Book::factory()->create();
        $response = $this->getJson('/api/book/' . $book->id);

        $response->assertOk()->assertJsonFragment([
            'isbn' => $book->isbn
        ]);
    });
});

describe('book:update', function () {
    it('updates a book', function () {
        $book = Book::factory()->create();
        $newDescription = fake()->text();

        $response = $this->putJson('/api/book/' . $book->id, [
            'description' => $newDescription
        ]);

        $response->assertOk()->assertJsonFragment([
            'description' => $newDescription
        ]);
    });
});

describe('book:destroy', function () {
    it('deletes a book', function () {
        $book = Book::factory()->create();

        $response = $this->deleteJson('/api/book/' . $book->id);

        $response->assertStatus(204);
        $this->assertDatabaseMissing('books', [
            'id' => $book->id
        ]);
    });
});
