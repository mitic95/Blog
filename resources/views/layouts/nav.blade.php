<div class="blog-masthead">
    <div class="container">
        <nav class="nav blog-nav">
            <a class="nav-link active" href="{{ route('home') }}">Home</a>
            <a class="nav-link" href="#">About Us</a>
            <a class="nav-link" href="#">Contact Us</a>
            <a class="nav-link" href="#">Support</a>

            @auth
                <a class="nav-link" href="{{ route('create') }}">Create Post</a>
                <a class="nav-link" href="{{ route('lists') }}">lists</a>
                <a class="nav-link" href="{{ route('profile') }}">Profile</a>
                <a class="nav-link" href="{{ route('logout') }}">Logout</a>
                <a class="nav-link ml-auto" href="#" style="position: relative; padding-left: 50px; overflow: hidden;">
                    <img class="rounded-circle" src="/storage/avatars/{{ Auth::user()->avatar }}" height="25" width="35">
                    {{ Auth::user()->name }}
                </a>
            @endauth

            @guest
                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                    <a class="nav-link" href="{{ route('register') }}">Register</a>
            @endguest

        </nav>
    </div>
</div>