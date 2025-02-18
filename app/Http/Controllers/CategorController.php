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
        $categor = Categor::all();
        return view('admin.categories.index', compact('categor'));
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.categories.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, ['name'=>'required']);

        $category = new Categor();
        $category->name = $request->name;
        $category->description = $request->description;
        $category->save();
        session('flash_message','تمت اضافة التصنيف بنجاح');
        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Categor $category)
    {
        $books = $category->books()->paginate(12);
        $title =  "الكتب التابعة ل" . $category->name;
        return view("Gallary", compact("books","title"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categor $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Categor $category)
    {
        
        $this->validate($request, ['name'=>'required']);

        $category->name = $request->name;
        $category->description = $request->description;
        $category->save();
        session()->flash('flash_message','تمت تحديث التصنيف بنجاح');
        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categor $category)
    {
        $category->delete();
        session()->flash('flash_message','تمت حذف التصنيف بنجاح');
        return redirect()->route('categories.index');
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
