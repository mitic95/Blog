@extends ('layouts.master')

@section ('content')
    <div class="col-sm-8 blog-main">

        @foreach($list as $lists)

            <h2>

                <a href="/posts/{{ $lists->id }}">

                    {{ $lists->title }}

                </a>

            </h2>

            <p class="blog-post-meta">

                {{ $lists->user->name }} on

                {{ $lists->created_at->toFormattedDateString() }}

            </p>

            {{ $lists->body }}

        @endforeach

        {!! $list->links() !!}

    </div><!-- /.blog-main -->
@endsection

@section ('footer')

    <script src="/js/file.js"></script>

@endsection