@extends('layout')

@section('content')
    <section class="content">
        <form method="POST" action="{{ route('books.store') }}">
            @csrf
            <div class="mb-3 mt-3">
              <label for="inputName" class="form-label">Name:</label>
              <input type="text" class="form-control" id="inputName" placeholder="Enter name" name="name" value="{{ old('name', $book->name ?? null) }}">
            </div>
            <div class="mb-3 mt-3">
                <label for="authors" class="form-label">Author(s):</label>
                <select id='authors' class="form-select select2" multiple name="authors_list[]">
                    @foreach ($authors as $author)
                        <option value="{{ $author->id }}">{{ $author->firstname }} {{ $author->lastname }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3 mt-3">
                <label for="publishers" class="form-label">Publisher(s):</label>
                <select id='publishers' class="form-select select2" multiple name="publishers_list[]">
                    @foreach ($publishers as $publisher)
                        <option value="{{ $publisher->id }}">{{ $publisher->name }}</option>
                    @endforeach
                </select>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </section>
@endsection

@section('javascript')
    <script>
        $(".select2").select2();
    </script>
@endsection
