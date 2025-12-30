@extends('layouts.app')

@section('title', 'Show Post')

@push('styles')
<link rel="stylesheet" href="{{ asset('CSS/showpost.css') }}">
@endpush

@section('content')

<div class="progress">
  <div class="progress-bar" id="progressBar"></div>
</div>

<main class="page">
  <div class="container">

    <section class="hero">
      <div class="hero-wrap">

        @if($post->image)
          <img class="hero-img" src="{{ asset('img/'.$post->image) }}">
        @else
          <img class="hero-img"
              src="https://images.unsplash.com/photo-1518779578993-ec3579fee39f?auto=format&fit=crop&w=1600&q=80">
        @endif

        <div class="hero-glass"></div>

        <div class="hero-content">
          <h1 class="hero-title">{{ $post->title }}</h1>



          <a class="btn ghost" href="{{ route('blog') }}">Back to Blog</a>
        </div>

      </div>
    </section>

    <section class="article">
      <article class="article-card">

        <div class="article-body" id="postContent">
          {!! nl2br(e($post->description)) !!}

          <hr>

          <div class="article-footer">
            <div class="author">
              <div class="avatar">
                {{ substr($post->user_name, 0, 1) }}
              </div>

              <div class="author-info">
                <div class="author-name">{{ $post->user_name }}</div>
                <div class="author-sub">Author</div>
              </div>
            </div>

            <button class="chip" id="shareBtn">Share</button>
          </div>

        </div>
      </article>


      <section class="comments">

        <h3>Comments ({{ count($post->comments) }})</h3>

        @if(auth()->check())
          <form method="POST" action="{{ route('comments.store', $post->id) }}">
            @csrf
            <textarea name="body" rows="3" required></textarea>
            <button type="submit" class="btn primary">Add Comment</button>
          </form>
        @else
          <p>Please <a href="{{ route('login') }}">login</a> to comment</p>
        @endif


        @foreach($post->comments as $c)
          <div class="comment">
            <strong>{{ $c->user->name }}</strong>
            <p>{{ $c->body }}</p>
          </div>
        @endforeach

      </section>

    </section>

  </div>
</main>

@push('scripts')
<script src="{{ asset('JS/showpost.js') }}"></script>
@endpush

@endsection