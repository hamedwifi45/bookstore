<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Book;

class Categor extends Model
{
    use HasFactory;
    public function Books(){
        return $this->hasMany(Book::class);
    }
}
