{{-- @props(['posts'])  --}}
{{-- we can received as posts props without create another function posts in the Post model --}}
{{-- or we can create posts computem function and then its will be available in the components --}}
<div class=" px-3 lg:px-7 py-6">
    <div class="flex justify-between items-center border-b border-gray-100">
        <div>
            @if ($search || $this->activeCategory)
            <x-button class="" wire:click='clearFilters()'>X</x-button>
            @endif
            @if ($search)
                Searching For: {{ $search }}
            @endif

            @if ($this->activeCategory)
                Category:
                <x-category-badge wire:navigate href="{{ route('blog.index', ['category' => $this->activeCategory->slug]) }}"
                    bgColor="{{ $this->activeCategory->bg_color }}" textColor="{{ $this->activeCategory->text_color }}">
                    {{ $this->activeCategory->title }}
                </x-category-badge>
            @else
            @endif
        </div>

        <div id="filter-selector" class="flex items-center space-x-4 font-light ">
            <button class="{{ $sort === 'desc' ? 'text-gray-900 py-4 border-b' : 'border-gray-700' }}  py-4"
                wire:click="setSort('desc')">Latest</button>

            <button class="{{ $sort === 'asc' ? 'text-gray-900 py-4 border-b' : 'border-gray-700' }}"
                wire:click="setSort('asc')">Oldest</button>
        </div>
    </div>
    <div class="py-4">
        {{-- @dd($posts) --}}
        {{-- with passing props --}}
        {{-- @foreach ($posts as $post) --}}
        {{-- with declare posts function in the model --}}
        @foreach ($this->posts as $post)
            <x-post.post-item :post="$post" />
        @endforeach

    </div>

    <div class="py-4">
        {{ $this->posts->onEachSide(1)->links() }}
    </div>
</div>
