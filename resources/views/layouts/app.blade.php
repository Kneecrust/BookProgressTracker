<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Progress Tracker</title>
    @vite('resources/css/app.css')
    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-gray-100 text-gray-900 dark:bg-gray-900 dark:text-gray-100">
<!-- Navigation Menu -->
<nav class="bg-white dark:bg-gray-800 shadow-md p-4">
    <div class="container mx-auto grid grid-cols-3 items-center">
        <!-- Left Spacer (Empty) -->
        <div></div>

        <!-- Centered Menu -->
        <div class="flex justify-center space-x-6 text-xl">
            <a href="{{ route('home') }}" class="text-gray-700 dark:text-gray-300 hover:text-blue-500">Home</a>
            <div class="relative group">
                <a href="{{ route('books.index') }}"
                   class="text-gray-700 dark:text-gray-300 hover:text-blue-500">
                    Books
                </a>
            </div>
            <a href="{{ route('authors.index') }}" class="text-gray-700 dark:text-gray-300 hover:text-blue-500">Authors</a>
            <a href="{{ route('genres.index') }}" class="text-gray-700 dark:text-gray-300 hover:text-blue-500">Genres</a>
        </div>

        <!-- Right: Dark Mode Toggle -->
        <div class="flex justify-end">
            <button id="theme-toggle" class="p-2 rounded bg-gray-200 dark:bg-gray-700">
                <span id="theme-icon">🌑</span>
            </button>
        </div>
    </div>
</nav>


<div class="container mx-auto p-4">
    @yield('content')
</div>

<script>
    // Check localStorage for dark mode preference
    document.addEventListener('DOMContentLoaded', () => {
        const themeToggle = document.getElementById('theme-toggle');
        const themeIcon = document.getElementById('theme-icon');
        const isDarkMode = localStorage.getItem('theme') === 'dark';

        if (isDarkMode) {
            document.documentElement.classList.add('dark');
            themeIcon.textContent = '☀️';
        }

        themeToggle.addEventListener('click', () => {
            document.documentElement.classList.toggle('dark');
            const isDark = document.documentElement.classList.contains('dark');
            localStorage.setItem('theme', isDark ? 'dark' : 'light');
            themeIcon.textContent = isDark ? '☀️' : '🌑';
        });
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

</body>
</html>
