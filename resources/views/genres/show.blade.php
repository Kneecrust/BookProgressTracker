@extends('layouts.app')

@section('content')
    <h1 class="text-3xl font-bold mb-4">Books in {{ $genre->name }}</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach ($genre->books as $book)
            <div class="p-4 border rounded shadow bg-white dark:bg-gray-700 dark:text-gray-200">
                <h2 class="text-xl font-semibold">{{ $book->title }}</h2>
                <p class="text-gray-600">Author: {{ $book->author->name }}</p>
                <a href="{{ route('books.show', $book->id) }}" class="text-blue-500">View Details</a>
            </div>
        @endforeach
    </div>
@endsection
