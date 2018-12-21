@extends ('layouts.master')

@section ('content')

    <div class="col-sm-8 blog-main">

        <div class="author-img">
            <img class="rounded-circle" src="/storage/avatars/{{ $authorName->avatar }}"> <em><b>{{ $authorName->name }}`s Posts</b></em>
        </div>

        <div class="col-sm-offset-12" id="products">

            {{$author->links("pagination::bootstrap-4")}}

            @foreach($author as $authors)

                @include('posts.authors')

            @endforeach

            {{$author->links("pagination::bootstrap-4")}}

        </div>

        <script>

            // Pagination
            $(document).on('click','.pagination a', function (e) {
                e.preventDefault();

                var page = $(this).attr('href').split('page=')[1];

                getProducts(page)

            });

            function getProducts(page) {
                $.ajax({
                    url: '/author/{{ $authorName->id }}/ajax/products?page='+ page
                }).done(function (data) {
                    $("#products").html(data);

                    location.hash = page;

                });
            }

        </script>

    </div><!-- /.blog-main -->

@endsection

@section ('footer')

    <script src="/js/file.js"></script>

@endsection