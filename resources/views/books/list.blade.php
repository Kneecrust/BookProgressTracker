@extends('layouts.app')

@section('content')
    <h1 class="text-3xl font-bold mb-4">All Books</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach ($books as $book)
            <div class="p-4 border rounded shadow bg-white">
                <h2 class="text-xl font-semibold">{{ $book->title }}</h2>
                <p class="text-gray-600">
                    <a href="{{ route('authors.show', $book->author->id) }}" class="text-gray-600 hover:underline">
                        {{ $book->author->name }}
                    </a>
                </p>
                <a href="{{ route('books.show', $book->id) }}" class="text-blue-500">View Details</a>
            </div>
        @endforeach
    </div>
@endsection
