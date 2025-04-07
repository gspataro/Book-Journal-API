<?php

use App\Rules\Isbn;
use Illuminate\Support\Facades\Validator;

describe('validation:isbn', function () {
    test('valid isbn10', function () {
        $isbn = fake()->isbn10();
        $validator = Validator::make([
            'isbn10' => $isbn
        ], [
            'isbn10' => new Isbn()
        ]);

        expect($validator->passes())->toBeTrue();
    });

    test('valid isbn13', function () {
        $isbn = fake()->isbn13();
        $validator = Validator::make([
            'isbn13' => $isbn
        ], [
            'isbn13' => new Isbn()
        ]);

        expect($validator->passes())->toBeTrue();
    });

    test('invalid isbn', function () {
        $validator = Validator::make([
            'isbn10' => '012345678912'
        ], [
            'isbn10' => new Isbn()
        ]);

        expect($validator->fails())->toBeTrue();
    });
});
