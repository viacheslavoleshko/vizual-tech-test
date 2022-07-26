<table id="example" class="table table-striped" style="width:100%">
    <thead>
        <tr>
            <th>Name</th>
            <th>Authors</th>
            <th>Publisher</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($publishers->getData()->data as $publisher)
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
                </tr>
            @endforeach
        @endforeach

    </tbody>
    <tfoot>
        <tr>
            <th>Name</th>
            <th>Authors</th>
            <th>Publisher</th>
        </tr>
    </tfoot>
</table>

<nav>
    <ul class="pagination">
        <li class="page-item {{ ($publishers->getData()->meta->current_page == 1) ? ' disabled' : '' }}">
            <a class="page-link" href="{{ $publishers->getData()->meta->links[$publishers->getData()->meta->current_page-1]->url }}">Previous</a>
        </li>
        @for ($i = 1; $i <= $publishers->getData()->meta->last_page; $i++)
            <li class="page-item {{ ($publishers->getData()->meta->current_page == $i) ? ' active' : '' }}">
                <a class="page-link" href="{{ $publishers->getData()->meta->links[$i]->url }}">{{ $i }}</a>
            </li>
        @endfor
        <li class="page-item {{ ($publishers->getData()->meta->current_page == $publishers->getData()->meta->last_page) ? ' disabled' : '' }}">
            <a class="page-link" href="{{ $publishers->getData()->meta->links[$publishers->getData()->meta->current_page+1]->url }}">Next</i></a>
        </li>
    </ul>
</nav>
