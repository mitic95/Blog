@extends ('layouts.master')

@section ('content')

    <div class="col-sm-8 blog-mail">

        <h1>{{ $post->title }}</h1>

        @if(Auth::user() == $post->user)

        <a href="{{ route('post-delete', ['post_id' => $post->id]) }}">Delete</a>

        @endif

        @if(count($post->tags))

            @foreach($post->tags as $tag)

                <li>

                    <a href="/posts/tags/{{ $tag->name }}">

                        {{ $tag->name }}

                    </a>

                </li>

            @endforeach

        @endif

        {{ $post->body }}

        <hr>

        <div class="comments">
            <ul>
            @foreach ($post->comments as $comment)
                    <li class="list-group-item">

                        <strong>
                            {{ $comment->created_at->diffForHumans() }}: &nbsp;
                        </strong>

                        {{ $comment->body }}

                    </li>
                @endforeach
            </ul>
        </div>

        <hr>

        <div class="card">

            <div class="card-block">

                <form method="POST" action="/posts/{{ $post->id }}/comments">

                    {{ csrf_field() }}

                    <div class="form-group">

                        <textarea name="body" placeholder="Your comment here" class="form-control"></textarea>

                    </div>

                    <div class="form-group">

                        <button type="submit" class="btn btn-primary">Add Comment</button>

                    </div>

                </form>

                @include ('layouts.errors')

            </div>

        </div>

    </div>

@endsection