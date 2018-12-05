@extends ('layouts.master')

@section ('content')

    <div class="col-sm-8 blog-main">

        <div class="col-sm-offset-12" id="products">

            {{$posts->links("pagination::bootstrap-4")}}

            @foreach($posts as $post)

                @include('posts.post')

            @endforeach

            {{$posts->links("pagination::bootstrap-4")}}

        </div>

    </div><!-- /.blog-main -->

@endsection

@section ('footer')

    <script src="/js/file.js"></script>

@endsection