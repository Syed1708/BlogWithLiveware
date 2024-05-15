<?php

namespace App\Livewire;

use Livewire\Component;

use function Laravel\Prompts\search;

class SearchBox extends Component
{

    public $search = '';

    //using livewire life circle hook
    //updated then hook name to run a event

    //this is hook updated
    public function updatedSearch(){
        //now dispatch an search event 
        //then listen it inside postlist because it will pass throw this components
        $this->dispatch('search', search:$this->search);
    }

    // regular function for button search
    public function buttonSearch(){
        //now dispatch an search event 
        //then listen it inside postlist because it will pass throw this components
        $this->dispatch('search', search:$this->search);
    }

    public function render()
    {
        return view('livewire.search-box');
    }
}
