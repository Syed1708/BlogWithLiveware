@props(['featured_post'])


<div class="md:col-span-1 col-span-3">
    <a href="#">
        <div>
            <img class="w-full rounded-xl"
                src="{{ $featured_post->image }}">
        </div>
    </a>
    <div class="mt-3">
        <div class="flex items-center mb-2">
            <a href="#" class="bg-blue-400 
                text-white 
                rounded-xl px-3 py-1 text-sm mr-3">
                PHP</a>
            <p class="text-gray-500 text-sm">{{ $featured_post->published_at }}</p>
        </div>
        <a href="#" class="text-xl font-bold text-gray-900"> {{ $featured_post->title }}
        </a>
    </div>
</div>
