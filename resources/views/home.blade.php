<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">


    <link rel="stylesheet" href="{{ asset('homestyle.css') }}">
</head>
<body>

@php

    $featured = null;
    if(isset($posts) && $posts->count() > 0){
        $featured = $posts[0];
    }


    $latest3 = [];
    if(isset($posts) && $posts->count() > 1){
        $latest3 = $posts->slice(1,3);
    }
@endphp


<nav class="navigation">
    <div class="nav-container">

        <a href="{{ route('home') }}" class="logo">
            <span class="logo-dot" aria-hidden="true"></span>
            <span class="logo-text">PLUTO</span>
        </a>

        <div class="nav-menu" id="navMenu">
            <a href="{{ route('home') }}" class="nav-link">Home</a>
            <a href="{{ route('blog') }}" class="nav-link">Blog</a>
            <a href="{{ route('about') }}" class="nav-link">About</a>

            @if(auth()->check())
                <a href="{{ route('dashboard') }}" class="nav-link">Dashboard</a>

                <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                    @csrf
                    <button type="submit" class="nav-link" style="background:none;border:none;cursor:pointer;">
                        Logout
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="nav-link">Login</a>
            @endif
        </div>

        <button class="menu-toggle" id="menuToggle" aria-label="Toggle menu">
            <span class="hamburger"></span>
        </button>
    </div>
</nav>


<section class="hero">
    <div class="hero-content">
        <h1 class="hero-title">Charm/Blog</h1>
        <p class="hero-subtitle">For Your Minimalist Personal Blog or Magazine</p>

        <div class="hero-divider">
            <div class="divider-line"></div>
            <div class="divider-dot"></div>
            <div class="divider-line"></div>
        </div>
    </div>
</section>


<section class="featured-post">
    <div class="container">

        @if($featured)
            <a class="featured-card" href="{{ route('post.show', $featured->id) }}">

                @if($featured->image)

                <img
                        src="https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&fit=crop&w=1600&q=80"
                        alt="{{ $featured->title }}"
                        class="featured-image"
                        loading="lazy"
                    >
                @else
                    <div class="featured-image" style="background: linear-gradient(135deg,#2C2C2C,#6B6B6B);"></div>
                @endif

                <div class="featured-overlay"></div>

                <div class="featured-content">
                    <span class="featured-badge">Featured Post</span>
                    <h2 class="featured-title">{{ $featured->title }}</h2>

                    <p class="featured-excerpt">
                        {{ \Illuminate\Support\Str::limit($featured->description, 160) }}
                    </p>

                    <span class="btn-outline">
                        Read More
                        <svg class="arrow-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M5 12h14M12 5l7 7-7 7"/>
                        </svg>
                    </span>
                </div>
            </a>
        @else
            <div style="text-align:center; padding:40px 0; color:#6B6B6B;">
                No posts yet. Add your first post 
            </div>
        @endif

    </div>
</section>


<section class="blog-grid">
    <div class="container">

        <div class="section-header">
            <h2 class="section-title">Latest Posts</h2>
            <p class="section-subtitle">Thoughtful stories and insights.</p>
        </div>

        <div class="posts-grid">

            @if(count($latest3) > 0)

                @foreach($latest3 as $post)
                    <a class="post-card" href="{{ route('post.show', $post->id) }}" style="text-decoration:none;">

                        <div class="post-image-wrapper">
                            @if($post->image)
                                <img src="{{ asset('img/'.$post->image) }}" alt="{{ $post->title }}" class="post-image" loading="lazy">
                            @else
                                <div class="post-image" style="background:#E5E0DC;"></div>
                            @endif

                            <span class="post-category">Latest</span>
                        </div>

                        <div class="post-content">
                            <h3 class="post-title">{{ $post->title }}</h3>

                            <p class="post-excerpt">
                                {{ \Illuminate\Support\Str::limit($post->description, 120) }}
                            </p>

                            <div class="post-meta">
                                <span class="meta-item">{{ $post->created_at?->format('M d, Y') }}</span>
                                <span class="meta-item">{{ $post->created_at?->diffForHumans() }}</span>
                            </div>
                        </div>

                    </a>
                @endforeach

            @else
                <div style="text-align:center; color:#6B6B6B;">
                    No latest posts.
                </div>
            @endif

        </div>

        <div style="display:flex; justify-content:center; margin-top: 28px;">
            <a class="btn-outline" href="{{ route('blog') }}">
                All Posts
                <svg class="arrow-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M5 12h14M12 5l7 7-7 7"/>
                </svg>
            </a>
        </div>

    </div>
</section>

<script src="{{ asset('JS/home.js') }}"></script>
</body>
</html>