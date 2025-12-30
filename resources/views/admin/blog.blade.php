@extends('layouts.app')

@section('title', 'Blog')

@section('content')

<section class="blog-grid">
<div class="container">

    <h1>Blog</h1>
    <p>All posts in one place</p>

    @if(auth()->check() && auth()->user()->usertype == 'admin')
        <a href="{{ route('admin.posts.create') }}">
        + Add Post
        </a>
    @endif

    <div class="posts-grid">

    @foreach($posts as $post)

        <div class="post-card" style="margin-bottom:20px;">

            @if($post->image)
                <img src="{{ asset('img/'.$post->image) }}" style="width:100%;">
            @else
                <div style="background:#eee; padding:40px; text-align:center;">
                    No Image
                </div>
            @endif

            <h3>{{ $post->title }}</h3>

        <p>
            {{ Str::limit($post->description, 130) }}
        </p>

        <small>
            {{ $post->created_at->diffForHumans() }}
        </small>

        <br><br>

        <a href="{{ route('post.show', $post->id) }}">
            Read More
        </a>

        </div>

    @endforeach

    @if($posts->count() == 0)
        <p>No posts yet.</p>
    @endif

    </div>

    <br>

    {{ $posts->links() }}

</div>
</section>

@endsection