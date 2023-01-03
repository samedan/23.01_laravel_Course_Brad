<?php

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// All Listings
Route::get('/', function () {
    return view('listings', [
        'heading' => 'latest listings',
        'listings' => Listing::all()
    ]);
});

// Single listing - Eloquent Models (check the route)
Route::get('/listings/{listing}', function(Listing $listing) {
    
    return view('listing', [
        'listing'=> $listing
    ]);
});

Route::get('/hello', function () {
    return response('<h1>Hello world</h1>')->header('Content-Type', 'text/plain');
});

Route::get('/posts/{id}', function($id) {
    ddd($id);
    return response ('Post '.$id);
})->where('id', '[0-9]+');

Route::get('/search', function(Request $request) {
    dd($request->name .' '. $request->city);
});


