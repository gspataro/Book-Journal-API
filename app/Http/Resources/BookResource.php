<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * App\Http\Resources\BookResource
 *
 * @property int $id
 * @property string $isbn
 * @property string $title
 * @property string $authors
 * @property string $publisher
 * @property string $edition
 * @property string $language
 * @property string $publication_date
 * @property string $image
 * @property int $pages
 * @property string $description
 * @property string $created_at
 * @property string $updated_at
 */
class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $authors = explode(', ', $this->authors);

        return [
            'id' => $this->id,
            'isbn' => $this->isbn,
            'title' => $this->title,
            'authors' => $authors,
            'publisher' => $this->publisher,
            'edition' => $this->edition,
            'language' => $this->language,
            'publication_date' => $this->publication_date,
            'image' => $this->image,
            'pages' => $this->pages,
            'description' => $this->description,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
