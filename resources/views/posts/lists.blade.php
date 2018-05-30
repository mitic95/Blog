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