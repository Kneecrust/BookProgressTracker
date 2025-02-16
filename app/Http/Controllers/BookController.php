<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::latest()->take(5)->get(); // Get last 5 books added
        $currentlyReading = Book::whereNotNull('progress')->whereNull('finished_reading')->get();

        return view('books.index', compact('books', 'currentlyReading'));
    }

    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }

    public function list()
    {
        $books = Book::orderBy('title')->get(); // Get all books, ordered by title
        return view('books.list', compact('books'));
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
