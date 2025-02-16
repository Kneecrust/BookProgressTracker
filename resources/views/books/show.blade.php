@extends('layouts.app')

@section('content')
    <div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow dark:bg-gray-700 dark:text-gray-200"">
        <h1 class="text-3xl font-bold">{{ $book->title }}</h1>
        <p class="text-gray-600">by
            <a href="{{ route('authors.show', $book->author->id) }}" class="text-blue-500 hover:underline">
                {{ $book->author->name }}
            </a>
        </p>
        <p class="mt-2">{{ $book->description }}</p>

        <!-- Progress Section -->
        <h2 class="text-2xl mt-4">Reading Progress</h2>

        <!-- Page Number Inputs -->
        <div class="mt-2 space-y-2">
            <label class="block">Total Pages:</label>
            <input type="number" id="total-pages" value="{{ $book->total_pages ?? '' }}" min="1"
                   class="border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700
           text-gray-900 dark:text-gray-200 p-2 w-full rounded focus:ring-2
           focus:ring-blue-500 dark:focus:ring-blue-400 focus:outline-none" oninput="calculateProgress(true)">

            <label class="block mt-2">Current Page:</label>
            <input type="number" id="current-page" value="{{ $book->total_pages ? floor(($book->progress / 100) * $book->total_pages) : 0 }}"
                   min="0" class="border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700
           text-gray-900 dark:text-gray-200 p-2 w-full rounded focus:ring-2
           focus:ring-blue-500 dark:focus:ring-blue-400 focus:outline-none" oninput="calculateProgress(false)">
        </div>

        <!-- Slider + Buttons -->
        <div class="flex items-center space-x-4 mt-4">
            <button onclick="adjustProgress(-5)" class="px-3 py-1 bg-gray-300 dark:bg-gray-700 text-gray-900 dark:text-gray-200
           hover:bg-gray-400 dark:hover:bg-gray-600 rounded text-lg">-5%</button>
            <input type="range" id="progress-slider" min="0" max="100" value="{{ $book->progress }}"
                   class="w-full cursor-pointer bg-gray-300 dark:bg-gray-600 rounded-lg appearance-none h-2" onchange="updateProgress(this.value)">
            <button onclick="adjustProgress(5)" class="px-3 py-1 bg-gray-300 dark:bg-gray-700 text-gray-900 dark:text-gray-200
           hover:bg-gray-400 dark:hover:bg-gray-600 rounded text-lg">+5%</button>
        </div>

        <!-- Display Current Progress -->
        <p class="text-lg mt-2">Progress: <span id="progress-value">{{ $book->progress }}</span>%</p>
    </div>

    <!-- JavaScript for Progress Calculation & AJAX -->
    <script>
        let isTypingCurrentPage = false;
        let isTypingTotalPages = false;

        document.addEventListener("DOMContentLoaded", function () {
            updateCurrentPageInput();
        });

        function updateCurrentPageInput() {
            if (isTypingCurrentPage || isTypingTotalPages) return; // Don't override if the user is typing

            let totalPages = parseInt(document.getElementById('total-pages').value);
            let progress = parseFloat(document.getElementById('progress-slider').value);
            let currentPageInput = document.getElementById('current-page');

            if (totalPages > 0) {
                let currentPage = Math.floor((progress / 100) * totalPages);
                currentPageInput.value = currentPage;
            } else {
                currentPageInput.value = ""; // Keep empty if total pages is not set
            }
        }

        function calculateProgress(updateTotalPages) {
            let totalPages = parseInt(document.getElementById('total-pages').value);
            let currentPage = parseInt(document.getElementById('current-page').value);

            if (updateTotalPages) {
                saveTotalPages(totalPages);
                updateCurrentPageInput(); // Auto-calculate current page if total pages is set
            }

            if (totalPages > 0 && currentPage >= 0) {
                let progress = Math.min(100, Math.max(0, (currentPage / totalPages) * 100));
                document.getElementById('progress-slider').value = progress;
                updateProgress(progress);
            }
        }

        function updateProgress(value) {
            let totalPages = document.getElementById('total-pages').value;

            fetch("{{ route('books.updateProgress', $book->id) }}", {
                method: "PATCH",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({ progress: value, total_pages: totalPages })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById('progress-value').innerText = data.new_progress;
                        document.getElementById('total-pages').value = data.total_pages;
                        updateCurrentPageInput(); // Auto-update only if necessary
                    }
                });
        }

        function adjustProgress(amount) {
            let slider = document.getElementById('progress-slider');
            let newValue = Math.min(100, Math.max(0, parseInt(slider.value) + amount));
            slider.value = newValue;
            updateProgress(newValue);
        }

        function saveTotalPages(totalPages) {
            fetch("{{ route('books.updateProgress', $book->id) }}", {
                method: "PATCH",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({ total_pages: totalPages })
            });
        }

        // Prevent auto-updating while user types in the current page field
        document.getElementById('current-page').addEventListener('focus', function() {
            isTypingCurrentPage = true;
        });

        document.getElementById('current-page').addEventListener('blur', function() {
            isTypingCurrentPage = false;
            calculateProgress(false); // Recalculate after typing
        });

        // Prevent auto-updating while user types in the total pages field
        document.getElementById('total-pages').addEventListener('focus', function() {
            isTypingTotalPages = true;
        });

        document.getElementById('total-pages').addEventListener('blur', function() {
            isTypingTotalPages = false;
            updateCurrentPageInput(); // Auto-calculate current page if total pages is set
        });
    </script>
@endsection
