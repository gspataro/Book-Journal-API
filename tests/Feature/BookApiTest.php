<?php

use App\Models\Book;
use App\Models\User;
use Laravel\Sanctum\Sanctum;

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
            'page' => 3
        ]);

        $response->assertOk()->assertJsonCount(3, 'data');
    });
});
