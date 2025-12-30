@extends('layouts.app')
@section('title','Dashboard')

@push('styles')
<link rel="stylesheet" href="{{ asset('CSS/dashboard.css') }}">
@endpush

@section('content')

<div class="app">


<aside class="sidebar">

    <div class="logo">
      <span class="dot"></span>
      <div>
        <div class="logo-title">PLOTO</div>
        <div class="logo-sub">Admin</div>
      </div>
    </div>

    <nav class="menu">
      <a class="menu-item active" href="{{ route('admin.dashboard') }}">Posts</a>
      <a class="menu-item" href="{{ route('blog') }}">Blog</a>
      <a class="menu-item" href="{{ route('home') }}">Home</a>
    </nav>

    <div class="side-bottom">
      <div class="user">
        <div class="avatar">{{ strtoupper(substr(auth()->user()->name ?? 'A',0,1)) }}</div>
        <div>
          <div class="user-name">{{ auth()->user()->name ?? 'Admin' }}</div>
          <div class="user-sub">Manage</div>
        </div>
      </div>

      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button class="btn btn-ghost w100" type="submit">Logout</button>
      </form>
    </div>

  </aside>

  <main class="main">

    <header class="topbar">
      <h1 class="h1">Dashboard</h1>

      <div class="top-actions">
        <div class="search">
          <input id="searchInput" type="text" placeholder="Search..." />
          <span class="search-ico">⌕</span>
        </div>
      </div>
    </header>

    <section class="stats">
      <div class="stat">
        <div class="stat-label">Total</div>
        <div class="stat-value" id="totalPosts">{{ $posts->count() }}</div>
      </div>
      <div class="stat">
        <div class="stat-label">Published</div>
        <div class="stat-value" id="publishedCount">—</div>
      </div>
      <div class="stat">
        <div class="stat-label">Drafts</div>
        <div class="stat-value" id="draftsCount">—</div>
      </div>
    </section>

    <section class="card">
      <div class="card-head">
        <div class="card-title">Posts</div>
        <div class="card-sub muted">({{ $posts->count() }})</div>
      </div>

      <div class="table-wrap">
        <table class="table">
          <thead>
            <tr>
              <th style="width:60px;">#</th>
              <th>Post</th>
              <th style="width:160px;">Author</th>
              <th style="width:140px;">Date</th>
              <th style="width:180px;">Actions</th>
            </tr>
          </thead>

          <tbody id="postsBody">
            @foreach($posts as $i => $p)
              <tr>
                <td>{{ $i+1 }}</td>

                <td>
                  <div class="postcell">
                    <div class="thumb">
                      @if($p->image)
                        <img src="{{ asset('img/'.$p->image) }}" alt="img">
                      @else
                        <span>IMG</span>
                      @endif
                    </div>

                    <div class="postmeta">
                      <div class="title">{{ $p->title ?? 'Untitled' }}</div>
                      <div class="desc">{{ \Illuminate\Support\Str::limit($p->description ?? '', 60) }}</div>
                    </div>
                  </div>
                </td>

                <td>{{ $p->user_name ?? '—' }}</td>
                <td>{{ optional($p->created_at)->toDateString() }}</td>

                <td>
                  <a class="icon" href="{{ route('admin.posts.edit.page', $p->id) }}">Edit</a>

                  <form method="POST" action="{{ route('admin.posts.destroy', $p->id) }}"
                        style="display:inline;" onsubmit="return confirm('Delete this post?')">
                    @csrf
                    <button class="icon danger" type="submit">Delete</button>
                  </form>
                </td>
              </tr>
            @endforeach

            @if($posts->count() == 0)
              <tr>
                <td colspan="5" style="padding:16px;">No posts yet.</td>
              </tr>
            @endif
          </tbody>

        </table>
      </div>
    </section>

  </main>
</div>

@push('scripts')
<script src="{{ asset('JS/dashboard.js') }}"></script>
@endpush

@endsection