<div>
    <h3 class="text-lg font-semibold text-gray-900 mb-3">Recommended Topics</h3>
    <div class="topics flex flex-wrap justify-start gap-2">
        
        @foreach ($categories as $category)
            
        <x-category-badge 
        wire:navigate href="{{ route('blog.index',['category' => $category->slug])}}"
        bgColor="{{$category->bg_color}}" 
        textColor="{{$category->text_color}}">
            {{ $category->title }}
        </x-category-badge>
        

        @endforeach
    </div>
</div>