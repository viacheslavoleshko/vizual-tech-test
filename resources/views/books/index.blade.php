@extends('layout')

@section('content')
    <section class="content" id="books_table">
        @include('includes._pagination_data')
    </section>
@endsection

@section('javascript')
    <script>
        $(document).ready(function() {

            $(document).on('click', '.pagination a', function(event) {
                event.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                fetch_data(page);
            });

            function fetch_data(page) {
                $.ajax({
                    url: "/books/fetch_data?page=" + page,
                    success: function(data) {
                        $('#books_table').html(data);
                    }
                });
            }
        });
    </script>
@endsection
