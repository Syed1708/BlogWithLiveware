<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(){

        return view('blogs.index', [
            'posts' => Post::latest()->take(5)->get(),
        ]);
    }
}
