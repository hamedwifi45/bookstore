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
        $auther = Auther::all();
        return view('admin.auther.index', compact('auther'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.auther.create");

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, ['name'=>'required']);

        $auther = new Auther();
        $auther->name = $request->name;
        $auther->description = $request->description;
        $auther->save();
        session('flash_message','تمت اضافة التصنيف بنجاح');
        return redirect()->route('authers.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Auther $auther)
    {
        $books = $auther->books()->paginate(12);
        $title =  "الكتب التابعة ل" . $auther->name;
        return view("Gallary", data: compact("books","title"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Auther $auther)
    {
        return view('admin.auther.edit', compact('auther'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Auther $auther)
    {
        

        $this->validate($request, ['name'=>'required']);

        $auther->name = $request->name;
        $auther->description = $request->description;
        $auther->save();
        session()->flash('flash_message','تمت تحديث التصنيف بنجاح');
        return redirect()->route('authers.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Auther $auther)
    {
        $auther->delete();
        session()->flash('flash_message','تمت حذف التصنيف بنجاح');
        return redirect()->route('authers.index');
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
