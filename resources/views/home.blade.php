<x-app-layout>
    @section('hero')

   
    <div class="w-full text-center py-32">
        <h1 class="text-2xl md:text-3xl font-bold text-center lg:text-5xl text-gray-700">
            Welcome to <span class="text-yellow-500">&lt;SN&gt;</span> <span class="text-gray-900"> News</span>
        </h1>
        <p class="text-gray-500 text-lg mt-1">Best Blog in the universe</p>
        <a class="px-3 py-2 text-lg text-white bg-gray-800 rounded mt-5 inline-block"
            href="http://127.0.0.1:8000/blog">Start
            Reading</a>
    </div>

    @endsection


    <div class="mb-10">
        <div class="mb-16">
            <h2 class="mt-16 mb-5 text-3xl text-yellow-500 font-bold">Featured Posts</h2>
            <div class="w-full">
                <div class="grid grid-cols-3 gap-10 w-full">

                    @foreach ($featured_posts as $featured_post)

                    {{-- <x-post.featured-post-card featured_post="{{$featured_post}}"/> --}}
                    <x-post.featured-post-card :featured_post="$featured_post"/>

                    @endforeach

                    
                 
                   
                </div>
            </div>
            <a class="mt-10 block text-center text-lg text-yellow-500 font-semibold"
                href="http://127.0.0.1:8000/blog">More
                Posts</a>
        </div>
        <hr>

        <h2 class="mt-16 mb-5 text-3xl text-yellow-500 font-bold">Latest Posts</h2>
        <div class="w-full mb-5">
            <div class="grid grid-cols-3 gap-10 w-full">

                @foreach ($latest_posts as $latest_post)

                {{-- <x-post.featured-post-card latest_post="{{$latest_post}}"/> --}}
                <x-post.latest-post-card :latest_post="$latest_post"/>

                @endforeach

                
             
               
            </div>
        </div>
        {{ $latest_posts->links() }}
    </div>

</x-app-layout>