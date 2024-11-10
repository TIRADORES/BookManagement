<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $fillable = ["title", "author",  "genre", "published_year", "description"];
    protected $casts = [
        "title" => 'string', 
        "author" => 'string',  
        "genre" => 'string', 
        "published_year" => 'integer', 
        "description" => "string",
    ];
}
