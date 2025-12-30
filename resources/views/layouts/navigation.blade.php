<nav class="bg-white border-b">

    <div style="padding:15px; display:flex; justify-content:space-between; align-items:center;">

        <div>
            @if(Auth::check() && Auth::user()->usertype == 'admin')
                <a href="{{ route('admin.dashboard') }}">LOGO</a>
            @else
                <a href="{{ route('dashboard') }}">LOGO</a>
            @endif
        </div>

        <div>
            @if(Auth::check() && Auth::user()->usertype == 'admin')
                <a href="{{ route('admin.dashboard') }}">Dashboard</a> |
                <a href="{{ route('admin.addpost') }}">Add Post</a> |
                <a href="{{ route('admin.allpost') }}">All Posts</a>
            @else
                <a href="{{ route('dashboard') }}">Dashboard</a>
            @endif
        </div>

        <div>
            @if(Auth::check())
                <span>{{ Auth::user()->name }}</span>

                <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
            @endif
        </div>

    </div>

</nav>