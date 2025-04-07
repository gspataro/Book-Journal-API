<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    /** @use HasFactory<\Database\Factories\BookFactory> */
    use HasFactory;

    protected $fillable = [
        'isbn',
        'title',
        'authors',
        'publisher',
        'edition',
        'language',
        'publication_date',
        'image',
        'pages',
        'description'
    ];
}
