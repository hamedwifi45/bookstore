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
    public function ratings(){
        return $this->hasMany(Rating::class);
    }
    
    public function rate(){
        return $this->ratings()->count() > 0 ? $this->ratings()->sum('value') / $this->ratings()->count() : 0;
    }
    
    
    
}
