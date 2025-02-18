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
        $categor = Publisher::all();
        return view('admin.publisher.index' , compact('categor'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.publisher.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, ['name'=>'required']);

        $publisher = new Publisher();
        $publisher->name = $request->name;
        $publisher->addreas = $request->addreas;
        $publisher->save();
        session('flash_message','تمت اضافة الناشر بنجاح');
        return redirect()->route('publishers.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Publisher $publisher)
    {
        
        $books = $publisher->books()->paginate(12);
        $title =  "الكتب التابعة ل" . $publisher->name;
        return view("Gallary", compact("books","title"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Publisher $publisher)
    {

        return view('admin.publisher.edit', compact('publisher'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Publisher $publisher)
    {
        $publisher->name = $request->name;
        $publisher->addreas = $request->addreas;
        $publisher->save();
        session()->flash('flash_message','تمت تحديث الناشر بنجاح');
        return redirect()->route('publishers.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Publisher $publisher)
    {
        $publisher->delete();
        session()->flash('flash_message','تمت حذف التصنيف بنجاح');
        return redirect()->route('publishers.index');
    }
    public function search(Request $request){
        $publisher = Publisher::where('name','like','%'. $request->term . '%')->get()->sortBy('name');
        $title = ' الناشر باسم ' . $request->term;
        return view('publisher.index', compact('publisher','title'));
    }
    public function result(Publisher $publisher){
        $books = $publisher->books()->paginate(12);
        $title =  "الكتب التابعة ل" . $publisher->name;
        // dd($books , $title);
        return view("Gallary", compact("books","title"));
    }
    public function list(){
        $publisher = Publisher::all()->sortBy('name');
        $title = 'الناشرون';
        return view('publisher.index', compact ("title",'publisher'));
    }

}
