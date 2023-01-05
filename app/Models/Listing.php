<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;

    // The fillable property is used inside the model. It takes care of defining which fields are to be considered when 
    // the user will insert or update data. Only the fields marked as fillable are used in the mass assignment. This is 
    // done to avoid mass assignment data attacks when the user sends data from the HTTP request
    protected $fillable = [
        'title', 'company', 'location', 'website', 'email', 'description', 'tags', 'logo'
    ];

    public function scopeFilter($query, array $filters) {        
        // dd($filters['tag']);
        if($filters['tag'] ?? false) {
            // search into the 'tags' column of the 'listings' table of the DBB for the tag ('%' means before and after the word)
            $query->where('tags', 'like', '%'.request('tag').'%');
        }
        // 'search' is the name of the form input on /resources/views/partials/_search.blade
        if($filters['search'] ?? false) {
            // search into the 'tags, description & title' column of the 'listings' table of the DBB for the tag ('%' means before and after the word)
            $query->where('title', 'like', '%'.request('search').'%')
                ->orWhere('description', 'like', '%'.request('search').'%')
                ->orWhere('tags', 'like', '%'.request('search').'%');
        }
    }
}
