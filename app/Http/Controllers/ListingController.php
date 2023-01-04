<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{
    // Show all listings
    public function index () {

        // dd(request()->tag);
        return view('listings.index', [
            // filter comes from /Models/Listing-> scopefilter
            'listings' => Listing::latest()->filter(request(['tag', 'search']))->get()
        ]);
    }
    // Show Single listing
    public function show (Listing $listing) {
        return view('listings.show', [
            'listing'=> $listing
        ]);
    }

    // Create Listing
    public function create () {
        return view('listings.create');
    }

    // Store Listing
    public function store(Request $request) {
        // dd($request->all());
        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required', Rule::unique('listings', 'company')], // unique in the 'listings' table, the 'company' column
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);
        Listing::create($formFields);


        return redirect('/')->with('message', 'Listing created successfully!');
    }
}
