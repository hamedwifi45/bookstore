<?php

namespace App\Http\Controllers;

use App\Models\Categor;
use Illuminate\Http\Request;

class CategorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Categor $categor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categor $categor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Categor $categor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categor $categor)
    {
        //
    }
    public function result(Categor $categor){
        $books = $categor->books()->paginate(12);
        $title =  "الكتب التابعة ل" . $categor->name;
        return view("Gallary", compact("books","title"));
    }
    public function list(){
        $category = Categor::all()->sortBy('name');
        $title = 'التصنيفات';
        return view('categor.index', compact ("title",'category'));
    }
    public function search(Request $request){
        $category = Categor::where('name','like','%'. $request->term . '%')->get()->sortBy('name');
        $title = ' تصنيف باسم ' . $request->term;
        return view('categor.index', compact('category','title'));
    }

}
