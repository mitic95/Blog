{{$list->links("pagination::bootstrap-4")}}

@foreach($list as $lists)

    @include('posts.lists')

@endforeach

{{$list->links("pagination::bootstrap-4")}}