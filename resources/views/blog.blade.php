@extends('layouts.app')
@section('title','Blog')

@push('styles')
<link rel="stylesheet" href="{{ asset('CSS/blog.css') }}">
@endpush

@section('content')

@php

  $items = [];

  foreach($posts as $p){

  
    $title = 'Untitled';
    if($p->title){
      $title = $p->title;
    }


    $descText = '';
    if($p->description){
      $descText = $p->description;
    }
    $desc = \Illuminate\Support\Str::limit($descText, 160);


    $date = '';
    if($p->created_at){
      $date = $p->created_at->toDateString();
    }


    $img = null;
    if($p->image){
      $img = asset('img/'.$p->image);
    }


    $url = route('post.show', $p->id);


    $items[] = [
      'id' => $p->id,
      'title' => $title,
      'desc' => $desc,
      'category' => 'article',
      'date' => $date,
      'read' => 4,
      'img' => $img,
      'url' => $url,
    ];
  }
@endphp

<main class="layout">

  <aside class="sidebar" id="sidebar">

    <div class="sidebar__section">
      <div class="search">
        <svg class="search__icon" viewBox="0 0 24 24" width="18" height="18">
          <path fill="currentColor" d="M10 2a8 8 0 1 1 5.29 14.03l4.34 4.34-1.42 1.42-4.34-4.34A8 8 0 0 1 10 2Zm0 2a6 6 0 1 0 0 12 6 6 0 0 0 0-12Z"/>
        </svg>
        <input id="searchInput" class="search__input" type="text" placeholder="Search..." />
        <button id="clearSearch" class="search__clear" type="button">x</button>
      </div>
    </div>

    <div class="sidebar__section">
      <div class="sidebar__title">Layouts</div>
      <button class="pill active" data-layout="masonry" type="button">Masonry</button>
      <button class="pill" data-layout="grid" type="button">Grid</button>
    </div>

    <div class="sidebar__section">
      <div class="sidebar__title">Categories</div>
      <div class="sidebar__list" id="categoryList">
        <button class="side-link active" data-category="all" type="button">All</button>
        <button class="side-link" data-category="article" type="button">Article</button>
        <button class="side-link" data-category="article" type="button">HTML</button>
        <button class="side-link" data-category="article" type="button">CSS</button>
        <button class="side-link" data-category="article" type="button">PHP</button>
        <button class="side-link" data-category="article" type="button">SQL</button>
        <button class="side-link" data-category="article" type="button">LARAVEL</button>
        <button class="side-link" data-category="article" type="button">PYTHON</button>
      </div>
    </div>

    <div class="sidebar__section">
      <div class="sidebar__title">Quick Links</div>
      <a class="mini-link" href="{{ route('home') }}">Home</a>
      <a class="mini-link" href="{{ route('blog') }}">Blog</a>
      <a class="mini-link" href="{{ route('about') }}">About</a>

      @if(auth()->check())
        <a class="mini-link" href="{{ route('dashboard') }}">Dashboard</a>
      @else
        <a class="mini-link" href="{{ route('login') }}">Login</a>
      @endif
    </div>

    <div class="sidebar__section">
      <div class="sidebar__title">Follow</div>
      <div class="social">
        <a class="social__btn" href="https://twitter.com" target="_blank">X</a>
        <a class="social__btn" href="https://instagram.com" target="_blank">IG</a>
        <a class="social__btn" href="https://github.com/fawzibshyr" target="_blank">GH</a>
      </div>
    </div>

    <div class="sidebar__bottom">
      @if(auth()->check())
        <a href="{{ route('posts.create') }}" class="sidebar-cta">
          <span class="sidebar-cta__badge">+</span>
          <span class="sidebar-cta__text">
            <span class="sidebar-cta__title">Add Post</span>
            <span class="sidebar-cta__sub">Create a new article</span>
          </span>
        </a>
      @else
        <a href="{{ route('login') }}" class="sidebar-cta">
          <span class="sidebar-cta__badge">🔑</span>
          <span class="sidebar-cta__text">
            <span class="sidebar-cta__title">Login</span>
            <span class="sidebar-cta__sub">to add a post</span>
          </span>
        </a>
      @endif
    </div>

  </aside>

  <section class="content">

    <div class="content__head">
      <button class="mobile-sidebar-btn" id="toggleSidebar" type="button">☰ Filters</button>

      <div class="content__meta">
        <h1 class="content__title">Discover Posts</h1>
        <p class="content__subtitle">All Posts in one Place.</p>
      </div>

      <div class="content__tools">
        <select id="sortSelect" class="select">
          <option value="">Sort: Latest</option>
          <option value="">Sort: Oldest</option>
        </select>
      </div>
    </div>

    <div class="masonry" id="masonry">
      <div class="masonry__col"></div>
      <div class="masonry__col"></div>
      <div class="masonry__col"></div>
      <div class="masonry__col"></div>
    </div>

    <div class="grid hidden" id="grid"></div>

    <div class="load-more-wrap">
      <button id="loadMore" class="btn" type="button">Load More</button>
    </div>

  </section>

</main>

<script>
  window.__BLOG_BOOT__ = {
    items: @json($items),
    hasMore: {{ $posts->hasMorePages() ? 'true' : 'false' }},
    nextPage: {{ $posts->currentPage() + 1 }},
    loadUrl: "{{ route('blog.load') }}"
  };
</script>

@push('scripts')
<script src="{{ asset('JS/blog.js') }}"></script>
@endpush

@endsection
