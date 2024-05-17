<?php

namespace App\Livewire;

use App\Models\Category;
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
    #[Url()]
    public $category = '';

    // listen event search which came from SearchBox
    #[On('search')]
    public function updatedSearch($search){
    
        $this->search = $search;
        // dd($search);
    }

    // clear filters
    
    public function clearFilters(){
    
        $this->search = '';
        $this->category = '';
        $this->resetPage();
        
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
        // so category slug is null then it will not executing this function
        ->when($this->activeCategory, function($query){
            // now refer the scope declare in Post model
            $query->WithCategory($this->category);
        })
        ->where('title', 'like', "%{$this->search}%")
        ->paginate(10);
        // we can use also simple pagination with previous and next button 
        // return Post::published()->orderBy('published_at', 'desc')->simplePaginate();
    }

    // valid category
    #[Computed]
    public function activeCategory(){

        return Category::where('slug',$this->category)->first();
    
    }
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
