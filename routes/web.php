<?php

use App\Http\Controllers\ListingController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Listing;
use App\Models\Lists;

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




// Single Listing
// Route::get('/listings/{id}', function($id){
//     return view('listitem', [
//         // using the method created from the Listing class from Listing.php
//         'listing' => Listing::find($id)
//     ]);
// });

Route::get('/err', function(){
    return response()->json([
        'stuff' => phpinfo()
    ]);
});


Route::get('/hello', function(){
    return response('<h1>Hello World</h1>')
    ->header('Content-Type','text/plain')
    ->header('foo','bar');
});


    // wildcards {}
Route::get('/posts/{id}', function($id){
    //Helper methods ; dd(die & dump), ddd(die, dump and debug)
    ddd($id);
    return response('Post ' . $id);
})->where('id', '[0-9]+');
    // example url http://127.0.0.1:8000/posts/198


//Route::get('/search', function(Request $request){
//    // dd($request);
//    dd($request->name . ' ' . $request->city);
//});


// Common Resource Routes:
// index - Show all listings
// show - Show single listing
// create - Show form to create new listing
// store - Store new listing
// edit - Show form to edit listing
// update - Update listing
// destroy - Delete listing


// All Listings
Route::get('/', [ListingController::class, 'index']);

// Show Create Form
Route::get('/listings/create', [ListingController::class, 'create'])->middleware('auth');

// Store Listing Data
Route::post('/listings', [ListingController::class, 'store'])->middleware('auth');

// Show edit form
Route::get('/listings/{listing}/edit', [ListingController::class, 'edit'])->middleware('auth');

// Edit Submit to Update
Route::put('/listings/{listing}',[ListingController::class, 'update'])->middleware('auth');

// Delete Listing
Route::delete('/listings/{listing}',[ListingController::class, 'destroy'])->middleware('auth');

// Manage Listings
Route::get('/listings/manage', [ListingController::class, 'manage'])->middleware('auth');

// Single Listing
Route::get('/listings/{listing}', [ListingController::class, 'show']);

// Show register/create form
Route::get('/register', [UserController::class, 'register'])->middleware('guest');

// Create New user
Route::post('/users', [UserController::class, 'store']);

// Log User out
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');

// Show Login Form
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');

// Log in user
Route::post('/users/authenticate', [UserController::class, 'authenticate']);

