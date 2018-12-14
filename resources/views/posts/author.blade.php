@extends ('layouts.master')

@section ('content')

    <div class="col-sm-8 blog-main">

        <h2 style="margin-bottom: 40px; color: #5e5d5d;">{{ $authorName->name }}`s Posts</h2>

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

            //function getProducts(page) {
            //$.get( "/ajax/products/" + page, function( data ) {
            //$("#products").html();
            //for(var i = 0; i < data.length; i++) {
            //$('#products').append('<h3>' + data[i] + '</h3>')
            //}
            //});
            //}

        </script>

    </div><!-- /.blog-main -->

@endsection

@section ('footer')

    <script src="/js/file.js"></script>

@endsection