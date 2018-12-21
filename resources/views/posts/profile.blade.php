@extends ('layouts.master')

@section ('content')

    <div class="col-sm-8 blog-main">

        <h2>{{ $user->name }}`s Profile</h2>
        <hr>
        <div class="profile-img">
            <img src="/storage/avatars/{{ $user->avatar }}">

            <form action="{{ route('update_avatar') }}" method="post" enctype="multipart/form-data">
                <label>Update Profil Image</label><br>

                <input type="file" name="avatar"><br><br>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="submit" value="Upload" class="pull-right btn btn-sm btn-primary">
            </form>
        </div>

        <hr>

        <div class="profile-name">
            <form action="{{ route('update_name') }}" method="post">
                Change Name: <input type="text" name="name" id="update-name" value="{{ $user->name }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="submit" value="Update" class="pull-right btn btn-sm btn-primary">
            </form>
        </div>

    </div><!-- /.blog-main -->

@endsection

@section ('footer')

    <script src="/js/file.js"></script>

@endsection