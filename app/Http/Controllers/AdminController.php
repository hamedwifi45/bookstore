<?php

namespace App\Http\Controllers;

use App\Models\Auther;
use App\Models\Book;
use App\Models\Categor;
use App\Models\Publisher;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        $number_of_book = Book::count();
        $number_of_category = Categor::count();
        $number_of_publisher = Publisher::count();
        $number_of_auther = Auther::count();
        $bookv = Book::where('number_of_copy',"<", 10)->take(5)->get();
        $bookm = Book::orderBy("view","desc")->take(2)->get();
        return view("admin.index",compact("number_of_book","number_of_category","bookm",'bookv',"number_of_publisher","number_of_auther"));
    }
}
