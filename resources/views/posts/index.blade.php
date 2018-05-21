@extends ('layouts.master')

@section ('content')

            <div class="col-sm-8 blog-main">

                @foreach ($posts as $post)

                    @include ('posts.post')

                @endforeach

                    {!! $posts->links() !!}

            </div><!-- /.blog-main -->

@endsection

@section ('footer')

    <script src="/js/file.js"></script>

@endsection