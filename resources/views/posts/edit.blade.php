@extends ('layouts.master')

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

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
                <textarea id="body" name="body" class="form-control">{{ $post->body }}</textarea>
            </div>

            <div class="form-group">
                <label for="tags">Tags</label>
                <select class="form-control select2-selection--multiple" name="tags[]" multiple="multiple">
                    @foreach($tags as $tag)
                        <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Publish</button>
            </div>

            @include ('layouts.errors')

        </form>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

        <script type="text/javascript">

            $('.select2-selection--multiple').select2();

            $('.select2-selection--multiple').select2().val({!! json_encode($post->tags()->allRelatedIds()) !!}).trigger('change');

        </script>

    </div>

@endsection