<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Categor;

class Book extends Model
{
    
    use HasFactory;

    protected $guarded = [];
    public function categor(){
        return $this->belongsTo(Categor::class);
    }
    public function publisher(){
        return $this->belongsTo(Publisher::class);
    }
    public function auther(){
    return $this->belongsToMany(Auther::class,"book_auther");
    }
    public function rating(){
        return $this->belongsToMany(User::class,"rating");
    }
}
