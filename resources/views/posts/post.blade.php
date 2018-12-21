<div class="blog-post">

    <h2 class="blog-post-title">

        <a href="{{ route('show', ['id' => $post->id]) }}">

        {{ $post->title }}

        </a>

    </h2>

    <p class="blog-post-meta">

        <a href="{{ route('author', ['id' => $post->user->id]) }}">{{ $post->user->name }}</a> on

        {{ $post->created_at->toFormattedDateString() }}

    </p>

    <p class="blog-post-body">
        {{ $post->body }}
    </p>
</div>