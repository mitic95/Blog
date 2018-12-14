<div class="blog-post">

    <h2>
        <a href="/posts/{{ $authors->id }}">

            {{ $authors->title }}

        </a>
    </h2>

    <p class="blog-post-meta">

        {{ $authors->created_at->toFormattedDateString() }}

    </p>

    {{ $authors->body }}
</div>