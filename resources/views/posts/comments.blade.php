<div class="blog-post">

    <h2 class="blog-post-title">

        <a href="{{ route('show', ['id' => $comment->post->id]) }}">

            {{ $comment->post->title }}

        </a>

    </h2>

    <p class="blog-post-meta">

        <a href="{{ route('author', ['id' => $comment->post->user->id]) }}">{{ $comment->post->user->name }}</a>

        {{ $comment->post->created_at->toFormattedDateString() }}



    </p>

    <p class="blog-post-body">
        {{ $comment->post->body }}
    </p>
</div>