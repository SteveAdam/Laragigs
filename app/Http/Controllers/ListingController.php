<?php

namespace App\Http\Controllers;

use App\Models\Lists;
use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{
    // Show all listings
    public function index(){
        return view('listings.index', [
        'lists' => Lists::latest()->filter(request(['tag', 'search']))->paginate(5),
    ]);
        
    }

    //Show single listing
    public function show(Lists $listing){

        return view('listings.show', [
        // using the method created from the Listing class from Listing.php
        'listing' => $listing]);
    }
    
    // Show Create Form
    public function create(){
        return view('listings.create');
    }
    
    // Store Listing Data
    public function store(Request $request){
        $formFields = $request->validate([
        'title' => 'required',
        'company' => ['required', Rule::unique('lists', 'company')],
        'location' => 'required',
        'website' => 'required',
        'email' => ['required', 'email'],
        'tags' => 'required',
        'description' => 'required' 
    ]);
        
        if($request->hasFile('logo')){
            $formFields['logo'] = $request->file('logo')->store('logos','public');
        }
        
        $formFields['user_id'] = auth()->id();
        
        Lists::create($formFields);
        
//        Session::flash('message', 'Listing created');
        
        return redirect('/')->with('message', 'Listing Created');
    }
    
    // Show Edit Form
    public function edit(Lists $listing){
        return view('listings.edit', ['lists' => $listing]);
    }
    
    // Update the Form
    public function update(Request $request, Lists $listing) {
        
        // Make sure logged in User is owner
        if($listing->user_id != auth()->id()){
            abort(403, 'Unauthorized action');
        }
        
        $formFields = $request->validate(['title' => 'required',
        'company' => 'required',
        'location' => 'required',
        'website' => 'required',
        'email' => ['required', 'email'],
        'tags' => 'required',
        'description' => 'required' ]);
        
        if($request->hasFile('logo')){
            $formFields['logo'] = $request->file('logo')->store('logos','public');
        }

        $listing->update($formFields);
        
        return back()->with('message', 'Listing Updated');
    }
    
    public function destroy(Lists $listing){
        if($listing->user_id != auth()->id()){
            abort(403, 'Unauthorized action');
        }
        $listing->delete();
        return redirect('/')->with('message' , 'Listing Deleted');
    }
    
    public function manage(){
        return view('listings.manage', ['lists'=> auth()->user()->listings()->get()]);
    }
}
