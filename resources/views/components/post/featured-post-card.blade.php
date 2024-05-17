@props(['featured_post'])


<div class="md:col-span-1 col-span-3">
    <a href="#">
        <div>
            <img class="w-full rounded-xl" src="{{ $featured_post->getThumbnail() }}">
        </div>
    </a>
    <div class="mt-3">
        <div class="flex items-center mb-2 gap-x-2">
            @if ($category = $featured_post->categories()->first())
                
            <x-category-badge wire:navigate href="{{ route('blog.index', ['category' => $category->slug]) }}"
                bgColor="{{ $category->bg_color }}" textColor="{{ $category->text_color }}">
                {{ $category->title }}
            </x-category-badge>

            @endif

            <p class="text-gray-500 text-sm">{{ $featured_post->published_at }}</p>
        </div>
        <a href="#" class="text-xl font-bold text-gray-900"> {{ $featured_post->title }}
        </a>
    </div>
</div>
