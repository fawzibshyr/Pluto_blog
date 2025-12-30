<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'basic_blog')</title>

    <link rel="stylesheet" href="{{ asset('CSS/get-started.css') }}">
    @stack('styles')
</head>

<body>

<header class="topbar">
    <div class="topbar__inner">

        <a href="{{ route('home') }}" class="brand">
            <span class="brand__dot"></span>
            <span class="brand__name">PLUTO</span>
        </a>

        <div class="topbar__actions">

            <button class="icon-btn" type="button">
                <svg viewBox="0 0 24 24" width="18" height="18">
                    <path fill="currentColor"
                        d="M12 22a2 2 0 0 0 2-2h-4a2 2 0 0 0 2 2Zm6-6V11a6 6 0 1 0-12 0v5L4 18v1h16v-1l-2-2Z"/>
                </svg>
            </button>

            <button class="icon-btn" type="button">
                <svg viewBox="0 0 24 24" width="18" height="18">
                    <path fill="currentColor"
                        d="M19.14 12.94c.04-.31.06-.63.06-.94s-.02-.63-.06-.94l2.03-1.58a.5.5 0 0 0 .12-.64l-1.92-3.32a.5.5 0 0 0-.6-.22l-2.39.96c-.5-.38-1.04-.7-1.64-.94l-.36-2.54A.5.5 0 0 0 13.9 1h-3.8a.5.5 0 0 0-.49.42l-.36 2.54c-.6.24-1.14.56-1.64.94l-2.39-.96a.5.5 0 0 0-.6.22L2.7 7.48a.5.5 0 0 0 .12.64l2.03 1.58c-.04.31-.06.63-.06.94s.02.63.06.94L2.82 14.52a.5.5 0 0 0-.12.64l1.92 3.32c.13.22.39.3.6.22l2.39-.96c.5.38 1.04.7 1.64.94l.36 2.54c.05.24.25.42.49.42h3.8c.24 0 .45-.18.49-.42l.36-2.54c.6-.24 1.14-.56 1.64-.94l2.39.96c.22.08.47 0 .6-.22l1.92-3.32a.5.5 0 0 0-.12-.64l-2.03-1.58Z"/>
                </svg>
            </button>

            @if(auth()->check())
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="icon-btn" type="submit">⎋</button>
                </form>
            @else
                <a class="icon-btn" href="{{ route('login') }}">🔑</a>
            @endif

        </div>

    </div>
</header>

<main>
    @yield('content')
</main>

@stack('scripts')

</body>
</html>