<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $now = Carbon::now();
        // dd($now);
        // $featured_posts = Post::where('published_at', '<=', Carbon::now())->take(3)->get();
        $featured_posts = Post::published()->featured()->latest('published_at')->take(3)->get();
        // $latest_posts = Post::latest()->paginate(6);
        $latest_posts = Post::published()->latest('published_at')->simplePaginate(6);
        // dd($featured_posts);
        return view('home', compact('featured_posts','latest_posts'));
    }
}
