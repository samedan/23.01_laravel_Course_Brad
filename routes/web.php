<?php

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListingController;

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
Route::get('/listings/create', [ListingController::class, 'create']);

// Store Listing Data
Route::post('/listings', [ListingController::class, 'store']);

// Single listing - Eloquent Models (check the route)
Route::get('/listings/{listing}', [ListingController::class, 'show']);

// Show edit Form
Route::get('/listings/{listing}/edit', [ListingController::class, 'edit']);

// Update Listing
Route::put('/listings/{listing}', [ListingController::class, 'update']);

// Delete Listing
Route::delete('/listings/{listing}', [ListingController::class, 'destroy']);

// Show Register Form
Route::get('/register', [UserController::class, 'create']);

// Create New User
Route::post('/users', [UserController::class, 'store']);

// Log User Out
Route::post('/logout', [UserController::class, 'logout']);

// Show Log In form
Route::get('/login', [UserController:: class, 'login']);

// Log in User
Route::post('/users/authenticate', [UserController::class, 'authenticate']);

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


