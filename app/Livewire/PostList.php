<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class PostList extends Component
{
    use WithPagination;

    #[Url()]
    public $sort = 'desc';
    #[Url()]
    public $search = '';

    // listen event search which came from SearchBox
    #[On('search')]
    public function updatedSearch($search){
    
        $this->search = $search;
        // dd($search);
    }

    // set sorting order
    public function setSort($sort){
        $this->sort = ($sort === 'desc') ? 'desc' : 'asc';
        // $this->resetPage();
    }

    #[Computed]
    public function posts(){

        return Post::published()
        ->orderBy('published_at', $this->sort) 
        ->where('title', 'like', "%{$this->search}%")
        ->paginate(2);
        // we can use also simple pagination with previous and next button 
        // return Post::published()->orderBy('published_at', 'desc')->simplePaginate();
    }

    // listen the event come from SearchBox
    
    public function render()
    {
        // with props 
        // $posts = Post::take(6)->get();
        // return view('livewire.post-list',[
        //     'posts' => $posts,
        // ]);
    //    without props
        return view('livewire.post-list');
    }
}
