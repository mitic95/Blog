@extends ('layouts.master')

@section ('content')

    <div class="col-sm-8 blog-main">

        <h2>{{ $user->name }}`s Profile</h2>
        <hr>
        <img src="/storage/avatars/{{ $user->avatar }}" style="width: 150px; height: 150px; float: left; border-radius: 50%; margin-right: 25px;">

        <form action="{{ route('update_avatar') }}" method="post" enctype="multipart/form-data">
        <label>Update Profil Image</label><br>

            <input type="file" name="avatar"><br><br>

            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <input type="submit" class="pull-right btn btn-sm btn-primary">
        </form>

    </div><!-- /.blog-main -->

@endsection

@section ('footer')

    <script src="/js/file.js"></script>

@endsection