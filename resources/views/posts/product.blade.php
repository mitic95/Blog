{!! $posts->links() !!}

@foreach($posts as $post)

    @include('posts.post')

@endforeach

{!! $posts->links() !!}