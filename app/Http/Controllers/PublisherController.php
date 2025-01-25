<?php

namespace App\Http\Controllers;

use App\Models\Publisher;
use Illuminate\Http\Request;

class PublisherController extends Controller
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
    public function show(Publisher $publisher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Publisher $publisher)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Publisher $publisher)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Publisher $publisher)
    {
        //
    }
    public function search(Request $request){
        $publisher = Publisher::where('name','like','%'. $request->term . '%')->get()->sortBy('name');
        $title = ' الناشر باسم ' . $request->term;
        return view('publisher.index', compact('publisher','title'));
    }
    public function result(Publisher $categor){
        $books = $categor->books()->paginate(12);
        $title =  "الكتب التابعة ل" . $categor->name;
        return view("Gallary", compact("books","title"));
    }
    public function list(){
        $publisher = Publisher::all()->sortBy('name');
        $title = 'الناشرون';
        return view('publisher.index', compact ("title",'publisher'));
    }

}
