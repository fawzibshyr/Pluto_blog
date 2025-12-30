@extends('layouts.app')

@section('title', 'Edit Posts')

@section('content')

<h1>Edit Posts</h1>
<p>Choose a post to edit</p>

<div class="posts-grid">

    @foreach($posts as $post)

        <div class="post-card" style="margin-bottom:20px;">

            @if($post->image)
                <img src="{{ asset('img/'.$post->image) }}" width="100%">
            @else
                <div style="background:#eee; padding:40px; text-align:center;">
                    No Image
                </div>
            @endif

            <h3>{{ $post->title }}</h3>

            <p>
                {{ Str::limit($post->description, 120) }}
            </p>

            <a href="{{ route('admin.posts.edit.page', $post->id) }}">
                Edit
            </a>

        </div>

    @endforeach

    @if($posts->count() == 0)
        <p>No posts found.</p>
    @endif

</div>

<br>

{{ $posts->links() }}

@endsection