@extends ('layouts.master')

@section ('content')

    <div class="col-sm-8 blog-mail">

        <h1>Edit a Post</h1>

        <hr>

        <form action="{{ route('update', ['post_id' => $post->id]) }}" method="POST">

            {{ csrf_field() }}

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="exampleInputEmail1" name="title" value="{{ $post->title }}">
            </div>

            <div class="form-group">
                <label for="body">Body</label>
                <textarea id="body" name="body" class="form-control"></textarea>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Publish</button>
            </div>

            @include ('layouts.errors')

        </form>

    </div>

@endsection