<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Models\Auther;
use App\Models\Categor;
use App\Models\Publisher;
use Illuminate\Validation\Rule;
use App\Traits\ImageUploadTrait;


class BookController extends Controller
{   
    use ImageUploadTrait;
        /*
        *
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
        // dd($request);
        $data = $this->validate($request, ['title' => 'required',
        "isbn" => ['required','alpha_num' , Rule::unique("books", 'isbn')],
        "cover_image" => 'image|required',
        'categor_id' => 'nullable',
        'publisher_id' => 'nullable' ,
        'description' => 'nullable',
        'publish_year' => 'numeric|nullable',
        'number_of_page' => 'numeric|required',
        'number_of_copy' => 'numeric|required',
        'price' => 'numeric|required'
    ]);
    // dd($data , $request);

    if ($request->hasFile('cover_image')) {
        $filename = $this->uploadImg($request->file('cover_image'));
        $data['cover_image'] = $filename;
    }
    $book = Book::create($data);
    if ($request->has('author')) 
    {
        $inder = $request['author'];
        foreach ($inder as $fee) {
            $book->auther()->attach($fee);
    }
    }
    session()->flash('flash_message' , 'تمت اضافة المنتج بفشل ذريع ');
    return redirect()->route('books.show' , $book);
}
    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        // dd($book);
        // $book = Book::find( $book );
        return view('admin.book.show',compact('book'));
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
        $book->delete();
        return redirect()->route('books.index');
    }
    public function details(Book $book)
    {
        $book->view += 1;
        $book->save();
        return view("books.details", compact("book"));
    }
}
