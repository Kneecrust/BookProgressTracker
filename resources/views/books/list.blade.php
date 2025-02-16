@extends('layouts.app')

@section('content')
    <h1 class="text-3xl font-bold mb-4">All Books</h1>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <!-- Alpine.js Wrapper (Ensure Everything is Inside This) -->
        <div x-data="{ open: false }" x-cloak id="add-book-modal-wrapper">
            <button @click="open = true"
                    class="w-full h-full flex flex-col items-center justify-center p-6 border border-dashed border-gray-300
               dark:border-gray-600 rounded-lg shadow-md hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none">
                <span class="text-5xl text-gray-400 dark:text-gray-300">+</span>
            </button>

            <!-- Modal Overlay -->
            <div x-show="open" x-cloak
                 class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50">
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg max-w-xl w-full">
                    <h2 class="text-2xl font-bold mb-4 text-gray-900 dark:text-gray-100">Add a New Book</h2>
                    <!-- FORM -->
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
                        <div class="flex justify-between mt-4">
                            <!-- Cancel Button (Left) -->
                            <button @click="open = false"
                                    class="px-4 py-2 text-gray-600 dark:text-gray-300 bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 rounded">
                                Cancel
                            </button>
                            <!-- Add Book Button (Right) -->
                            <button type="submit"
                                    class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded">
                                Add Book
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    @foreach ($books as $book)
            <div class="p-4 border rounded shadow bg-white dark:bg-gray-700 dark:text-gray-200">
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
