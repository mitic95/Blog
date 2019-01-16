{{$posts->links("pagination::bootstrap-4")}}

@foreach($posts as $post)

    @include('posts.post')

@endforeach

{{$posts->links("pagination::bootstrap-4")}}