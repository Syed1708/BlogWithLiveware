<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;


    // create scope for Published
    public function scopePublished($query){

        $query->where('published_at', '<=', Carbon::now());
    }

    // create scope for Featured
    public function scopeFeatured($query){

        $query->where('featured', true);
    }
}
