@extends ('layouts.master')

@section ('content')

    <div class="col-sm-8 blog-main">

        <div class="col-sm-offset-12" id="products">

            {!! $posts->links() !!}

            @foreach($posts as $post)

                @include('posts.post')

            @endforeach

            {!! $posts->links() !!}

        </div>

    </div><!-- /.blog-main -->

@endsection

@section ('footer')

    <script src="/js/file.js"></script>

@endsection