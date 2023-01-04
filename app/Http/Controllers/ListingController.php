<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    // Show all listings
    public function index () {

        // dd(request()->tag);
        return view('listings.index', [
            // filter comes from /Models/Listing-> scopefilter
            'listings' => Listing::latest()->filter(request(['tag']))->get()
        ]);
    }
    // Show Single listing
    public function show (Listing $listing) {
        return view('listings.show', [
            'listing'=> $listing
        ]);
    }
}
