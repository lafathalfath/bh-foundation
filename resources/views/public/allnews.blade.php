@extends('layout.public')
@section('content')
    <main class="container mx-auto px-5 md:px-9">
        <!-- Grid Berita -->
        <section class="py-20 ">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
                @foreach ($allnews as $item)
                    <div class="border rounded-lg overflow-hidden shadow-md">
                        <img src="{{ $item->image }}" alt="News Image" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <h3 class="text-xl font-bold mb-2">
                                <a href="#" class="hover:text-green-600">
                                    {{ $item->title }}
                                </a>
                            </h3>
                            <p class="text-gray-600 text-sm mb-3">
                                {{ $item->date }}
                            </p>
                            <p class="text-gray-800 mb-4">
                                {{ $item->description }}
                            </p>
                            <a href="#">
                            <button class="btn btn-outline btn-warning mt-4">Read More...</button>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mb-5">
                {{ $allnews->links() }}
            </div>
        </section>
    </main>
@endsection
