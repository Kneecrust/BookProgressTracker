@extends('layouts.app')

@section('content')
    <h1 class="text-3xl font-bold mb-4">Genres</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach ($genres as $genre)
            <div class="p-4 border rounded shadow bg-white dark:bg-gray-700 dark:text-gray-200">
                <h2 class="text-xl font-semibold">{{ $genre->name }}</h2>
                <p class="text-gray-600">{{ $genre->books->count() }} books</p>
                <a href="{{ route('genres.show', $genre->id) }}" class="text-blue-500">View Books</a>
            </div>
        @endforeach
    </div>
@endsection
