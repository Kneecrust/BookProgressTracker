<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Genre;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::latest()->take(3)->get();
        $currentlyReading = Book::whereNotNull('progress')->whereNull('finished_reading')->get();
        $authors = Author::all();
        $genres = Genre::all();

        return view('books.index', compact('books', 'currentlyReading','authors', 'genres'));
    }

    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }

    public function list()
    {
        $books = Book::orderBy('title')->get(); // Get all books, ordered by title
        $authors = Author::all();
        $genres = Genre::all();
        return view('books.list', compact('books','authors', 'genres'));
    }

    public function updateProgress(Request $request, Book $book)
    {
        $validated = $request->validate([
            'progress' => 'nullable|numeric|min:0|max:100',
            'total_pages' => 'nullable|numeric|min:1'
        ]);

        if (isset($validated['progress'])) {
            $book->progress = $validated['progress'];
        }

        if (isset($validated['total_pages'])) {
            $book->total_pages = $validated['total_pages'];
        }

        $book->save();

        return response()->json([
            'success' => true,
            'new_progress' => $book->progress,
            'total_pages' => $book->total_pages
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $authors = Author::all();
        $genres = Genre::all();
        return view('books.create', compact('authors', 'genres'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author_id' => 'nullable|exists:authors,id',
            'new_author' => 'nullable|string|max:255',
            'genres' => 'array',
            'genres.*' => 'exists:genres,id',
            'new_genres' => 'nullable|string',
            'total_pages' => 'nullable|integer|min:1',
            'progress' => 'nullable|numeric|min:0|max:100',
            'reading_started_at' => 'nullable|date',
        ]);

        // Handle new author
        if (!empty($validated['new_author'])) {
            $author = Author::create(['name' => $validated['new_author']]);
            $validated['author_id'] = $author->id;
        }

        // Ensure an author is set
        if (empty($validated['author_id'])) {
            return back()->withErrors(['author_id' => 'Please select or add an author.']);
        }

        // Create the book
        $book = Book::create([
            'title' => $validated['title'],
            'author_id' => $validated['author_id'],
            'total_pages' => $validated['total_pages'] ?? null,
            'progress' => $validated['progress'] ?? 0,
            'reading_started_at' => $validated['reading_started_at'] ?? null,
        ]);

        // Handle new genres
        if (!empty($validated['new_genres'])) {
            $genreNames = array_map('trim', explode(',', $validated['new_genres']));
            $genreIds = [];

            foreach ($genreNames as $name) {
                $genre = Genre::firstOrCreate(['name' => $name]);
                $genreIds[] = $genre->id;
            }
            $validated['genres'] = array_merge($validated['genres'] ?? [], $genreIds);
        }

        // Attach genres (many-to-many)
        if (!empty($validated['genres'])) {
            $book->genres()->attach($validated['genres']);
        }

        return redirect()->route('books.index')->with('success', 'Book added successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
