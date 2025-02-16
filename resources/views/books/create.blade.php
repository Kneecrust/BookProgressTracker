@extends('layouts.app')

@section('content')
    <div class="max-w-2xl mx-auto bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
        <h1 class="text-2xl font-bold mb-4">Add a New Book</h1>

        <form action="{{ route('books.store') }}" method="POST">
            @csrf

            <!-- Title -->
            <label class="block text-gray-700 dark:text-gray-300">Title:</label>
            <input type="text" name="title" required
                   class="border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-200 p-2 w-full rounded focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400 focus:outline-none">

            <!-- Author Selection -->
            <label class="block mt-3 text-gray-700 dark:text-gray-300">Select an Author:</label>
            <select name="author_id"
                    class="border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-200 p-2 w-full rounded">
                <option value="" selected disabled>Select an author</option>
                @foreach($authors as $author)
                    <option value="{{ $author->id }}">{{ $author->name }}</option>
                @endforeach
            </select>

            <!-- OR Add New Author -->
            <label class="block mt-3 text-gray-700 dark:text-gray-300">Or Add a New Author:</label>
            <input type="text" name="new_author"
                   class="border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-200 p-2 w-full rounded"
                   placeholder="Enter new author name">

            <!-- Genre Selection -->
            <label class="block mt-3 text-gray-700 dark:text-gray-300">Select Genres:</label>
            <div class="grid grid-cols-2 gap-2">
                @foreach($genres as $genre)
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" name="genres[]" value="{{ $genre->id }}" class="form-checkbox dark:bg-gray-700">
                        <span class="text-gray-700 dark:text-gray-300">{{ $genre->name }}</span>
                    </label>
                @endforeach
            </div>

            <!-- OR Add New Genres -->
            <label class="block mt-3 text-gray-700 dark:text-gray-300">Or Add New Genres (comma-separated):</label>
            <input type="text" name="new_genres"
                   class="border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-200 p-2 w-full rounded"
                   placeholder="e.g., Fantasy, Mystery">

            <!-- Total Pages -->
            <label class="block mt-3 text-gray-700 dark:text-gray-300">Total Pages:</label>
            <input type="number" name="total_pages" min="1"
                   class="border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-200 p-2 w-full rounded">

            <!-- Progress -->
            <label class="block mt-3 text-gray-700 dark:text-gray-300">Progress (%):</label>
            <input type="number" name="progress" min="0" max="100"
                   class="border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-200 p-2 w-full rounded">

            <!-- Reading Started At -->
            <label class="block mt-3 text-gray-700 dark:text-gray-300">Reading Started At:</label>
            <input type="date" name="reading_started_at"
                   class="border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-200 p-2 w-full rounded">

            <!-- Submit Button -->
            <button type="submit" class="mt-4 bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                Add Book
            </button>
        </form>
    </div>
@endsection
