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
        // dd(Listing::latest()->filter(request(['tag', 'search']))->paginate(2));
        return view('listings.index', [
            // filter comes from /Models/Listing-> scopefilter
            'listings' => Listing::latest()->filter(request(['tag', 'search']))->paginate(6)
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
        // dd($request->file('logo'));
        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required', Rule::unique('listings', 'company')], // unique in the 'listings' table, the 'company' column
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        if($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
            // dd($request->file('logo')->store('logos', 'public'));
        }

        $formFields['user_id'] = auth()->id();
        // dd($formFields);
        Listing::create($formFields);


        return redirect('/')->with('message', 'Listing created successfully!');
    }

    // Show Edit Form
    public function edit(Listing $listing)  {
        // dd($listing);
        return view('listings.edit', ['listing'=>$listing]);
    }


    // Update Listing
    public function update(Request $request, Listing $listing) {
        // dd($request->file('logo'));
        // Make sur logged in user os owner
        if($listing->user_id != auth()->id()){
            abort(403, 'Unauthorised action');
        }
        $formFields = $request->validate([
            'title' => 'required',
            'company' => 'required', 
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        if($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
            // dd($request->file('logo')->store('logos', 'public'));
        }
        // dd($formFields);
        $listing->update($formFields);


        return back()->with('message', 'Listing updated successfully!');
    }

    // Delete Listing
    public function destroy(Listing $listing) {
        if($listing->user_id != auth()->id()){
            abort(403, 'Unauthorised action');
        }
        $listing->delete();
        return redirect('/')->with('message', 'Listing deleted successfully');
    }

    // Manage Listings
    public function manage() {
        return view('listings.manage', ['listings'=> auth()->user()->listings()->get()]);
    }
}
