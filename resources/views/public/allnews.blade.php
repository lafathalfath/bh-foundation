@extends('layout.public')
@section('content')
<style>
.hover-translate:hover {
    transform: translateY(-10px) !important;
}
</style>

    <main class="container mx-auto px-5 md:px-9">
        <!-- Grid Berita -->
        <section class="py-20 ">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
                @forelse ($allnews as $nw)
                    @php
                        $views = strval($nw->views);
                        if (strlen($views) >= 4 && strlen($views) < 7) $views = substr($views, 0, strlen($views)-3)."K";
                        if (strlen($views) >= 7 && strlen($views) < 10) $views = substr($views, 0, strlen($views)-6)."M";
                        if (strlen($views) >= 10) $views = substr($views, 0, strlen($views)-9)."B";
                    @endphp
                    <div class="border rounded-lg overflow-hidden shadow-md hover-translate" data-aos="zoom-in">
                        <figure class="w-full h-60 bg-gray-300 overflow-hidden border rounded-t-xl flex items-center justify-center">
                            <img src="{{ $nw->image_url }}"
                                alt="News Image" class="w-full h-full object-cover  ">
                        </figure>
                        <div class="card-body">
                            <h3 class="card-title">{{ $nw->title }}</h3>
                            <p class="w-full h-7 overflow-hidden text-start text-gray-600">{{ $nw->description }}</p>
                            <p class="w-full text-start text-gray-500">{{ substr($nw->published_at, 0, 10) }}</p>
                            <div class="w-full flex justify-end">
                                {{ $views }} views
                            </div>
                            <a href="{{ route('article', [
                                'type' => 'news',
                                'id' => Crypt::encryptString($nw->id)
                            ]) }}" class="btn btn-outline btn-warning mt-4">
                                Read More...
                            </a>
                        </div>
                    </div>
                @empty
                    <div>Empty</div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div>Showing 1 to 9 of 50 results</div>
            {{-- <div class="mb-5">
                {{ $allnews->links() }}
            </div> --}}
        </section>
    </main>
@endsection
