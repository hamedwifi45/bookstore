<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\CategorController;
use App\Http\Controllers\GallaryController;
use App\Http\Controllers\PublisherController;
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
Route::get('/category/{categor:name}' ,[CategorController::class ,'result'] )->name('Gallary.category.show');
Route::get('/category',[CategorController::class ,'list'] )->name('categor.list');
Route::get('/categor/search' ,[CategorController::class ,'search'] )->name('search.categor');
Route::get('/publisher/search' ,[PublisherController::class ,'search'] )->name('search.publisher');
Route::get('/publisher/{Publisher:name}' ,[PublisherController::class ,'result'] )->name('Gallary.publisher.show');
Route::get('/publisher',[PublisherController::class ,'list'] )->name('publisher.list');