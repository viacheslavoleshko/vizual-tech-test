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
            $request = Request::create('/api/books', 'GET');
            $response = Route::dispatch($request);

            return view('includes._pagination_data', ['publishers' => $response])->render();
        }
    }
}
