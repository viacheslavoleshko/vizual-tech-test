@extends('layout')

@section('content')
    <section class="content-header">
        <a class="btn btn-success btn-sm" href="{{ route('books.create') }}">Create Book</a>
    </section>

    <section class="content">
    <table id="example" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Authors</th>
                <th>Publisher</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($publishers as $publisher)
                @foreach ($publisher->books as $book)
                    <tr>
                        <td>{{ $book->name }}</td>
                        <td>
                            @foreach ($book->authors as $author)
                            {{ $author->firstname }} {{ $author->lastname }}
                                @if(!$loop->last)
                                    ,
                                @endif
                            @endforeach
                        </td>
                        <td>{{ $publisher->name }}</td>
                        <td>
                            <a class="btn btn-warning btn-sm" href="{{ route('books.edit', ['book' => $book]) }}">
                                <i class="fas fa-pencil-alt"></i>Edit
                            </a>
                            <form method="POST" id="delete-form" action="{{ route('books.destroy', ['book' => $book]) }}" class="d-inline-block">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-danger btn-sm" ><i class="fas fa-trash"></i>Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @endforeach

        </tbody>
        <tfoot>
            <tr>
                <th>Name</th>
                <th>Authors</th>
                <th>Publisher</th>
                <th></th>
            </tr>
        </tfoot>
    </table>
    {!! $publishers->links() !!}
    </section>

    {{-- <div>
        <ul class="pagination">
            <li class="page-item {{ ($companies->currentPage() == 1) ? ' disabled' : '' }}">
                <a class="page-link" href="{{ $companies->url($companies->currentPage()-1) }}">{{ __('admin.previous') }}</a>
            </li>
            @for ($i = 1; $i <= $companies->lastPage(); $i++)
                <li class="page-link {{ ($companies->currentPage() == $i) ? ' active' : '' }}">
                    <a href="{{ $companies->url($i) }}">{{ $i }}</a>
                </li>
            @endfor
            <li class="page-item {{ ($companies->currentPage() == $companies->lastPage()) ? ' disabled' : '' }}">
                <a class="page-link" href="{{ $companies->url($companies->currentPage()+1) }}">{{ __('admin.next') }}</i></a>
            </li>
        </ul>
    </div> --}}
@endsection
