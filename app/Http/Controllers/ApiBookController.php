<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Publisher;
use Illuminate\Http\Request;
use App\Http\Requests\BookRequest;
use App\Http\Resources\BookResource;

class ApiBookController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->only('store', 'update', 'destroy');
    }

    public function index()
    {
        $publishers = Publisher::with('books')->paginate(2);

        return BookResource::collection($publishers);
    }

    public function store(BookRequest $request)
    {
        $validatedData = $request->validated();

        $book = Book::create($validatedData);
        $book->authors()->sync($validatedData['authors_list']);
        $book->publishers()->sync($validatedData['publishers_list']);

        return response()->json($book->load('authors', 'publishers'));
    }

    public function update(BookRequest $request, Book $book)
    {
        $this->authorize($book);
        $validatedData = $request->validated();

        $book->update($validatedData);
        $book->authors()->sync($validatedData['authors_list']);
        $book->publishers()->sync($validatedData['publishers_list']);

        return response()->json($book->fresh()->load('publishers'));
    }

    public function destroy(Book $book)
    {
        $this->authorize($book);
        $book->delete();
        return response()->noContent();
    }
}
