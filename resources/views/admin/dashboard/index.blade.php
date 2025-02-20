@extends('layout.admin')
@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-2xl font-bold mb-4">Dashboard Admin</h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <a href="{{ route('manage.article') }}">
        <div class="bg-blue-500 text-white p-4 rounded-lg shadow-md flex items-center justify-between">
        <i class="fa-regular fa-newspaper text-8xl"></i>
            <div class="text-right">
            <h3 class="text-lg text-center justify-center">Total Post Articel</h3>
            <p class="text-2xl font-bold text-center justify-center">{{ $totalArticles }}</p>
            </div>
        </div>
        </a>
        
        <a href="{{ route('manage.categories') }}">
        <div class="bg-green-500 text-white p-4 rounded-lg shadow-md flex items-center justify-between">
        <i class="fa-solid fa-table-list text-8xl"></i>
            <div class="text-right">
            <h3 class="text-lg text-center justify-center">Total Article Category</h3>
            <p class="text-2xl font-bold text-center justify-center">{{ $totalArticlesCat }}</p>
            </div>
        </div>

        <a href="">
        <div class="bg-red-500 text-white p-4 rounded-lg shadow-md flex items-center justify-between">
        <i class="fa-solid fa-eye text-8xl"></i>
            <div class="text-right">
            <h3 class="text-lg text-center justify-center">Total View</h3>
            <p class="text-2xl font-bold text-center justify-center"></p>
            </div>
        </div>
        </a>

        <a href="{{ route('manage.page.about') }}">
        <div class="bg-purple-500 text-white p-4 rounded-lg shadow-md flex items-center justify-between">
        <i class="fa-solid fa-user-group text-8xl"></i>
            <div class="text-right">
            <h3 class="text-lg text-center justify-center">Total Member</h3>
            <p class="text-2xl font-bold text-center justify-center">{{ $totalMember }}</p>
            </div>
        </div>
        </a>
        
        <a href="{{ route('manage.program_type') }}">
        <div class="bg-yellow-500 text-white p-4 rounded-lg shadow-md flex items-center justify-between">
        <i class="fa-regular fa-newspaper text-8xl"></i>
            <div class="text-right">
            <h3 class="text-lg text-center justify-center">Total Article Types</h3>
            <p class="text-2xl font-bold text-center justify-center">{{ $totalArticlesType }}</p>
            </div>
        </div>
        </a>

        <a href="{{ route('manage.page.about') }}">
        <div class="bg-orange-500 text-white p-4 rounded-lg shadow-md flex items-center justify-between">
        <i class="fa-solid fa-handshake text-8xl"></i>
            <div class="text-right">
            <h3 class="text-lg text-center justify-center">Total Partner</h3>
            <p class="text-2xl font-bold text-center justify-center">{{ $totalPartner }}</p>
            </div>
        </div>
        </a>

    </div>
</div>
@endsection