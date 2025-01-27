<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Models\Auther;
use App\Models\Categor;
use App\Models\Publisher;
use Illuminate\Validation\Rule;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::all();
        return view("admin.book.index", compact("books"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $author = Auther::all();
        $publisher = Publisher::all();
        $categor = Categor::all();
        return view('admin.book.create',compact('author','publisher','categor'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        dd($request);
        $data = $this->validate($request, ['title' => 'required',
        "isbn" => ['required','alpha_num' , Rule::unique("books", 'isbn')],
        "cover_image" => 'image|required',
        'categor' => 'nullable',
        'publisher' => 'nullable' ,
        'author' => 'nullable',
        'description' => 'nullable',
        'publish_year' => 'numeric|nullable',
        'number_of_page' => 'numeric|required',
        'number_of_copy' => 'numeric|required',
        'price' => 'numeric|required'
    ]);
    Book::create($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        //
    }
    public function details(Book $book)
    {
        return view("books.details", compact("book"));
    }
}
