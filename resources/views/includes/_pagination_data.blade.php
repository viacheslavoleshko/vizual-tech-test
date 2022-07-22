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