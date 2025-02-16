@extends('layouts.app')

@section('content')
    <h1 class="text-3xl font-bold mb-4">Authors</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach ($authors as $author)
            <div class="p-4 border rounded shadow bg-white">
                <h2 class="text-xl font-semibold">{{ $author->name }}</h2>
                <p class="text-gray-600">{{ $author->books->count() }} books</p>
                @if ($author->books->count() > 0)
                <a href="{{ route('authors.show', $author->id) }}" class="text-blue-500">View Books</a>
                @else
                <span class="text-gray-400 cursor-not-allowed">No books for this author</span>
                @endif
            </div>
        @endforeach
    </div>
@endsection
