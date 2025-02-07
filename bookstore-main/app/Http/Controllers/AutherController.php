<?php

namespace App\Http\Controllers;

use App\Models\Auther;
use Illuminate\Http\Request;

class AutherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function show(Auther $auther)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Auther $auther)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Auther $auther)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Auther $auther)
    {
        //
    }
    public function search(Request $request){
        $auther = Auther::where('name','like','%'. $request->term . '%')->get()->sortBy('name');
        $title = ' المؤلف باسم ' . $request->term;
        return view('auther.index', compact('auther','title'));
    }
    public function result(Auther $auther){
        $books = $auther->books()->paginate(12);
        $title =  "الكتب التابعة ل" . $auther->name;
        // dd($books , $title);
        return view("Gallary", compact("books","title"));
    }
    public function list(){
        $auther = Auther::all()->sortBy('name');
        $title = 'المؤلفون';
        return view('auther.index', compact ("title",'auther'));
    }
}
