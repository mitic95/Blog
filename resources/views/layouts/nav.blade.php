<div class="blog-masthead">
    <div class="container">
        <nav class="nav blog-nav">
            <a class="nav-link active" href="{{ route('home') }}">Home</a>
            <a class="nav-link" href="#">New features</a>
            <a class="nav-link" href="#">Press</a>
            @if(Auth::check())
                <a class="nav-link" href="{{ route('create') }}">Create Post</a>
                <a class="nav-link" href="{{ route('lists') }}">lists</a>
                <a class="nav-link" href="{{ route('profile') }}">Profile</a>
                <a class="nav-link" href="{{ route('logout') }}">Logout</a>
                <a class="nav-link ml-auto" href="#" style="position: relative; padding-left: 50px;">
                    {{ Auth::user()->name }}
                </a>
            @else
                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                    <a class="nav-link" href="{{ route('register') }}">Register</a>
            @endif
        </nav>
    </div>
</div>