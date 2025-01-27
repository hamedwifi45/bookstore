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

        return view("admin.index",compact("number_of_book","number_of_category","number_of_publisher","number_of_auther"));
    }
}
