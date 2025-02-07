<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class GallaryController extends Controller
{
    public function index(){
        $books = Book::paginate(12);
        
        $title = 'معرض الكتب';
        return view('Gallary' , compact('title','books'));
    }
    public function search(Request $request){
        $books = Book::where('title','like','%'.$request->term.'%')->paginate(12);
        $title = "نتائج البحث عن " . $request->term;
        return view('Gallary' , compact('title','books'));
    }

}
