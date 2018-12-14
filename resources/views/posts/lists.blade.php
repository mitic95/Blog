<div class="blog-post">
    <h2>

        <a href="/posts/{{ $lists->id }}">

            {{ $lists->title }}

        </a>

    </h2>

    <p class="blog-post-meta">

        {{ $lists->created_at->toFormattedDateString() }}

    </p>

    {{ $lists->body }}
</div>