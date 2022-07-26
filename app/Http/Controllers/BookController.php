<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use App\Models\Publisher;
use Illuminate\Http\Request;
use App\Http\Requests\BookRequest;
use Illuminate\Support\Facades\Route;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $request = Request::create('/api/books', 'GET');
        $response = Route::dispatch($request);

        return view('books.index', ['publishers' => $response]);
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
    public function store(Request $request)
    {
        $request = Request::create('/api/books', 'POST', $request->all());
        $response = Route::dispatch($request);

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
    public function update(Request $request, Book $book)
    {
        $request = Request::create('/api/books/' . $book->id, 'PUT', $request->all());
        $response = Route::dispatch($request);

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
        $request = Request::create('/api/books/' . $book->id, 'DELETE');
        $response = Route::dispatch($request);

        return redirect()->route('books.index');
    }
}
