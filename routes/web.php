<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AutherController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategorController;
use App\Http\Controllers\GallaryController;
use App\Http\Controllers\PublisherController;
use App\Http\Controllers\UserController;
use App\Models\Auther;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('layouts.main');
// });

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('layouts.main');
    })->name('dashboard');
});

Route::get('/', [GallaryController::class , 'index'] )->name('Gallary.index');
Route::get('/search' ,[GallaryController::class ,'search'] )->name('search');
Route::get('/book/{book}' ,[BookController::class ,'details'] )->name('book.details');
Route::post('/book/{book}/rate' ,[BookController::class ,'rate'] )->name('book.rate');

Route::get('/category/{categor:name}' ,[CategorController::class ,'result'] )->name('Gallary.category.show');
Route::get('/category',[CategorController::class ,'list'] )->name('categor.list');
Route::get('/categor/search' ,[CategorController::class ,'search'] )->name('search.categor');

Route::get('/publisher/search' ,[PublisherController::class ,'search'] )->name('search.publisher');
Route::get('/publisher/{publisher:name}' ,[PublisherController::class ,'result'] )->name('Gallary.publisher.show');
Route::get('/publisher',[PublisherController::class ,'list'] )->name('publisher.list');

Route::get('/auther/search' ,[AutherController::class ,'search'] )->name('search.auther');
Route::get('/auther/{auther:name}' ,[AutherController::class ,'result'] )->name('Gallary.auther.show');
Route::get('/auther',[AutherController::class ,'list'] )->name('auther.list');

Route::prefix('/admin')->middleware('can:update_books')->group(function () {
    
    Route::get('/', [AdminController::class ,'index'] )->name('admin.index');
    Route::get('/books', [BookController::class ,'index'] )->name('books.index');
    Route::get('/books/create', [BookController::class ,'create'] )->name('books.create');
    Route::post('/books/store', [BookController::class ,'store'] )->name('books.store');
    Route::delete('/books/delete/{book}', [BookController::class ,'destroy'] )->name('books.delete');
    Route::get('/books/show/{book:title}', [BookController::class ,'show'] )->name('books.show');
    Route::get('/books/update/{book}', [BookController::class ,'edit'] )->name('book.edit');
    Route::patch('/books/update/{book}', [BookController::class ,'update'] )->name('books.update');
    Route::resource('/categories',CategorController::class);
    Route::resource('/publishers',PublisherController::class);
    Route::resource('/authers',AutherController::class);
    Route::resource('/users',UserController::class)->middleware('can:update_users');
});


Route::post('/cart',[CartController::class,'addToCart'])->name('cart.add');