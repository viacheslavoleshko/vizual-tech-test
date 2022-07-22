<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Models\Author;
use App\Models\Book;
use App\Models\Publisher;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $publishers = Publisher::with('books')->paginate(2);
        return view('books.index', ['publishers' => $publishers]);
    }

    function fetch_data(Request $request)
    {
        if($request->ajax())
        {
            $publishers = Publisher::with('books')->paginate(2);
            return view('includes._pagination_data', ['publishers' => $publishers])->render();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $authors = Author::all();
        $publishers = Publisher::all();
        return view('books.create', ['authors' => $authors ,'publishers' => $publishers]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookRequest $request)
    {
        $validatedData = $request->validated();

        $book = Book::create($validatedData);
        $book->authors()->sync($validatedData['authors_list']);
        $book->publishers()->sync($validatedData['publishers_list']);

        return redirect()->route('books.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        $authors = Author::all();
        $publishers = Publisher::all();
        return view('books.edit', ['book' => $book, 'authors' => $authors ,'publishers' => $publishers]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(BookRequest $request, Book $book)
    {
        $validatedData = $request->validated();

        $book->update($validatedData);
        $book->authors()->sync($validatedData['authors_list']);
        $book->publishers()->sync($validatedData['publishers_list']);

        return redirect()->route('books.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('books.index');
    }
}
