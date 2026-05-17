<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
     protected $fillable =[
        'title',
        'author',
        'year',
        'publisher',
        'cover',
        'city',
        'bookshelf_id',
    ];

    public function bookshelf()
    {
        return $this->belongsTo(Bookshelves::class);
    }
}
