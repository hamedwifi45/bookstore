<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function addTocart(Request $request){
        $book = Book::find($request->id);
        if(auth()->user()->bookInCart->contains($book)){
            $newQu = $request->quanity + auth()->user()->bookInCart()->where('book_id' , $book->id)->first()->pivot->number_of_copy;
            if($newQu > $book->number_of_copy){
                session()->flash('warning_message','لقد تجاوزت العدد الموجود من الكتاب لدينا العدد الذي لدينا هو ' . ($book->number_of_copy - auth()->user()->bookInCart()->where('book_id',$book->id)->first()->pivot->number_of_copy));
                return redirect()->back();
            }
            else{
                auth()->user()->bookInCart()->updateExistingPivot($book->id,['number_of_copy' => $newQu]);
            }
        }
        else{
            auth()->user()->bookInCart()->attach($request->id,['number_of_copy'=>  $request->quanity]);
        }
        $num_of_prod = auth()->user()->bookInCart()->count();
        return response()->json(['number_of_prod'=> $num_of_prod]);
    }
    public function viewCart(){
        $items = auth()->user()->bookInCart;
        return view('cart' , compact('items'));
    }
    public function remove_one(Book $book){
        $old = auth()->user()->bookInCart()->where('book_id' , $book->id)->first()->pivot->number_of_copy;
        if($old > 1){
            auth()->user()->bookInCart()->updateExistingPivot($book->id ,['number_of_copy' => --$old]);
        } else{
            auth()->user()->bookInCart()->detach($book->id);
        }
        return redirect()->back();
        
    }
    public function remove_all(Book $book){
        
    auth()->user()->bookInCart()->detach($book->id);
    
    return redirect()->back();
    }
}
