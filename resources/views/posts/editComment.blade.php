@extends ('layouts.master')

@section ('content')

    <div class="col-sm-8 blog-mail">

        <h1>{{ $comment->post->title }}</h1>

        <br>

        <div class="author-post">
            Author of this post: <a href="{{ route('author', ['id' => $comment->post->user->id]) }}"><img class="rounded-circle" src="/storage/avatars/{{ $comment->post->user->avatar }}" height="25" width="30"> <em>{{ $comment->post->user->name }}</em></a>
        </div>
        <hr>

        @if(Auth::user() == $comment->post->user)

            <div id="show-del-ed">
                <a href="{{ route('post-delete', ['post_id' => $comment->post->id]) }}" class="btn btn-primary">Delete</a>
                <br>
                <a href="{{ route('edit', ['id' => $comment->post->id]) }}" class="btn btn-primary">Edit</a>
            </div>

            <hr>

        @endif

        <div id="show-tag">
            <h3>Tags:</h3>
        </div>

        <div id="show-page-link">
            @if(count($comment->post->tags))

                @foreach($comment->post->tags as $tag)
                    <li>

                        <a href="/posts/tags/{{ $tag->name }}">

                            {{ $tag->name }}

                        </a>

                    </li>
                @endforeach

            @endif
        </div>

        <hr>

        {{ $comment->post->body }}

        <hr>

        <div class="comments">
            <ul>
                @foreach ($comment->post->comments as $comment)
                    <li class="list-group-item">
                        <div class="form-control">
                            <div class="profile-name">
                                <a href="{{ route('author', ['id' => $comment->user->id]) }}">
                                    <div class="profile-link">
                                        <img class="rounded-circle" src="/storage/avatars/{{ $comment->user->avatar }}" height="35" width="45"> <em>{{ $comment->user->name }}</em>
                                    </div>
                                </a>
                            </div>

                            <div class="div-strong">
                                <strong>
                                    {{ $comment->created_at->diffForHumans() }} &nbsp;
                                </strong>
                            </div>

                            <div class="form-control" id="comment-body">

                                @if(Auth::user() == $comment->user)

                                    <form method="POST" action="{{ route('update_comment', ['id' => $comment->id]) }}">

                                        {{ csrf_field() }}

                                        <div class="form-group">

                                            <textarea name="body" id="body" class="form-control">{{ $comment->body }}</textarea>

                                        </div>

                                        <div class="form-group">

                                            <button type="submit" class="btn btn-primary">Update</button>

                                        </div>

                                    </form>

                                    @include ('layouts.errors')

                                @else

                                    {{ $comment->body }}

                                @endif

                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

@endsection