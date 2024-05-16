<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'image',
        'content',
        'published_at',
        'featured',
    ];
    // create scope for Published
    public function scopePublished($query){

        $query->where('published_at', '<=', Carbon::now());
    }

    // create scope for Featured
    public function scopeFeatured($query){

        $query->where('featured', true);
    }

    protected $casts = [
        'published_at' => 'datetime',
    ];
    public function author(){

        return $this->belongsTo(User::class,'user_id');
    }

    public function categories(){

        return $this->belongsToMany(Category::class);
    }

    public function postExcerpt(){

        return Str::limit(strip_tags($this->content), 150);
    }

    
    public function readingSpeed(){

        $wordCount = str_word_count($this->content);
        $min = round($wordCount / 250); //250 words speed par min as a humain
        return ($min < 1) ? 1 : $min;
    }

    
}
