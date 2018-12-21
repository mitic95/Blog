<div class="blog-post">
    <h2>

        <a href="/posts/{{ $lists->id }}">

            {{ $lists->title }}

        </a>

    </h2>

    <p class="blog-post-meta">

        <i style="color: #4b4b4b">{{ $lists->user->name }}</i>

        {{ $lists->created_at->toFormattedDateString() }}

    </p>

    {{ $lists->body }}
</div>