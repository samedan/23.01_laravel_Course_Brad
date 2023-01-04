<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'company', 'location', 'website', 'email', 'description', 'tags'
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
