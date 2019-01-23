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

        <div id="show-page-link">
            @if(count($post->tags))

                <div id="show-tag">
                    <h3>Tags:</h3>
                </div>

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

        <br>

            <div class="interaction">
                <a class="like" href="#">{{ Auth::user()->likes()->where('post_id', $post->id)->first() ? Auth::user()->likes()->where('post_id', $post->id)->first()->like == 1 ? 'You like this post' : 'Like' : 'Like'}}</a>({{ $post->likes->where('like', 1)->count() }})
                <a class="like" href="#">{{ Auth::user()->likes()->where('post_id', $post->id)->first() ? Auth::user()->likes()->where('post_id', $post->id)->first()->like == 0 ? 'You don\'t like this post' : 'Dislike' : 'Dislike'}}</a>({{ $post->likes->where('like', 0)->count() }})
            </div>

        <hr>

        <div class="comments">
            <ul>
            @foreach ($post->comments as $comment)
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

                                @if(Auth::user() == $comment->user)
                                    <div class="comment-edit-delete">
                                        <a href="{{ route('edit_comment', ['id' => $comment->id]) }}">Edit</a>
                                        <a href="{{ route('delete_comment', ['id' => $comment->id]) }}">Delete</a>
                                    </div>
                                @endif

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

    <script>

        $('.like').on('click', function (event) {
            var token = '{{ Session::token() }}';
            var urlLike = '{{ route('like') }}';

            event.preventDefault();
            var postId = '{{ $post->id }}';
            var isLike = event.target.previousElementSibling == null; // true or false
            $.ajax({
                method: 'POST',
                url: urlLike,
                data: {isLike: isLike, postId: postId, _token: token}
            })
                .done(function () {
                    // Change the page (reload page)
                    event.target.innerText = isLike ? event.target.innerText == 'Like' ? 'You like this post' : 'Like' : event.target.innerText == 'Dislike' ? 'Yout don\'t like this post' : 'Dislike';
                    if (isLike){
                        event.target.nextElementSibling.innerText = 'Dislike';
                    } else {
                        event.target.previousElementSibling.innerText = 'Like';
                    }
                });
        });

    </script>

@endsection