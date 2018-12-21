@extends ('layouts.master')

@section ('content')

    <div class="col-sm-8 blog-mail">

        <h1>{{ $post->title }}</h1>

        <br>

        <div class="author-post">
            Author of this post: <a href="{{ route('author', ['id' => $post->user->id]) }}"><img class="rounded-circle" src="/storage/avatars/{{ $post->user->avatar }}" height="25" width="30"> <em>{{ $post->user->name }}</em></a>
        </div>
        <hr>

        @if(Auth::user() == $post->user)

            <div id="show-del-ed">
                <a href="{{ route('post-delete', ['post_id' => $post->id]) }}" class="btn btn-primary">Delete</a>
                <br>
                <a href="{{ route('edit', ['id' => $post->id]) }}" class="btn btn-primary">Edit</a>
            </div>

            <hr>

        @endif

        <div id="show-tag">
            <h3>Tags:</h3>
        </div>

        <div id="show-page-link">
            @if(count($post->tags))

                @foreach($post->tags as $tag)
                    <li>

                        <a href="/posts/tags/{{ $tag->name }}">

                            {{ $tag->name }}

                        </a>

                    </li>
                @endforeach

            @endif
        </div>

        <hr>

        {{ $post->body }}

        <hr>

        <div class="comments">
            <ul>
            @foreach ($post->comments as $comment)
                    <li class="list-group-item">
                        <div class="form-control" id="profile-name">
                            <a href="{{ route('author', ['id' => $comment->user->id]) }}">
                                <div class="profile-link">
                                    <img class="rounded-circle" src="/storage/avatars/{{ $comment->user->avatar }}" height="35" width="45"> <em>{{ $comment->user->name }}</em>
                                </div>
                            </a>

                            <div class="div-strong">
                                <strong>
                                    {{ $comment->created_at->diffForHumans() }} &nbsp;
                                </strong>
                            </div>

                            <div class="form-control" id="comment-body">

                                {{ $comment->body }}

                            </div>
                        </div>
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