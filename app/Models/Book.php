<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $with = ['authors'];

    public function authors()
    {
        return $this->belongsToMany(Author::class)->as('author_book');
    }

    public function publishers()
    {
        return $this->belongsToMany(Publisher::class)->as('book_publisher');
    }
}
