    <nav class="navbar navbar-expand-lg navbar-dark bg-dark" id="navbar">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01"
                aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                <a class="navbar-brand" href="#">
                    <span id="true">True</span>North<span class="text-info" id="news">News</span></a>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('posts.index') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('posts.create') }}">Create Article</a>
                    </li>
                </ul>
                @guest
                <div class="auth-info d-flex gap-3">
                    <a href="{{ route('login') }}" class="btn btn-outline-info me-2">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-outline-info me-2">Register</a>
                </div>
                @endguest
                @auth
                <div class="auth-info d-flex gap-3 align-items-center">
                    <span style="color: white;">Hi, <strong>{{ auth()->user()->name }}</strong></span>
                    <form class="d-flex" method="GET" action="{{ route('posts.profile') }}">
                        <button class="btn btn-outline-info me-2" type="submit">
                            Profile
                        </button>
                    </form>
                    @if(auth()->user()->role === 'admin')
                    <form class="d-flex" method="GET" action="{{ route('dashboard') }}">
                        <button class="btn btn-outline-info me-2" type="submit">
                            Admin Dashboard
                        </button>
                    </form>
                    @endif
                    <form class="d-flex" method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="btn btn-outline-danger me-2" type="submit">
                            Logout
                        </button>
                    </form>
                    @endauth
                </div>
            </div>
    </nav>