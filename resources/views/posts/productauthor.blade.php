{{$author->links("pagination::bootstrap-4")}}

@foreach($author as $authors)

    @include('posts.authors')

@endforeach

{{$author->links("pagination::bootstrap-4")}}