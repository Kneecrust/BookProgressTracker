@extends('layouts.app')

@section('content')
    <h1 class="text-3xl font-bold mb-4 mt-6">Currently Reading</h1>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach ($currentlyReading as $book)
            <div class="p-4 border rounded shadow bg-white dark:bg-gray-700 dark:text-gray-200">
                <h2 class="text-xl font-semibold">{{ $book->title }}</h2>
                <p class="text-gray-600 dark:text-gray-400">{{ $book->author->name }}</p>
                <p class="text-gray-600 dark:text-gray-400">Progress: {{ $book->progress }}%</p>
                <a href="{{ route('books.show', $book->id) }}" class="text-blue-500">Update Progress</a>
            </div>
        @endforeach
    </div>

    <h1 class="text-3xl font-bold mb-4 mt-6">Recently Added Books</h1>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach ($books as $book)
            <div class="p-4 border rounded shadow bg-white dark:bg-gray-700 dark:text-gray-200">
                <h2 class="text-xl font-semibold">{{ $book->title }}</h2>
                <a href="{{ route('authors.show', $book->author->id) }}"  class="text-gray-600 dark:text-gray-400">{{ $book->author->name }}</>
                <p class="text-gray-600 dark:text-gray-400 italic">
                    {{ $book->genres->pluck('name')->implode(', ') }}
                </p>
                <a href="{{ route('books.show', $book->id) }}" class="text-blue-500">View Details</a>
            </div>
        @endforeach
    </div>


@endsection
