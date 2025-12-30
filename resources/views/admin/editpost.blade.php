@extends('layouts.app')

@section('title', isset($post) ? 'Update Post' : 'Edit Posts')

@section('content')

<section class="blog-grid">
<div class="container">

    @if(isset($post))

    <div class="section-header">
        <h1 class="section-title">Update Post</h1>
        <p class="section-subtitle">Edit the post and save</p>
    </div>

    @if(session('status'))
        <div style="color:green; margin-bottom:10px;">
        {{ session('status') }}
        </div>
    @endif

    <form method="POST"
            action="{{ route('admin.posts.update', $post->id) }}"
            enctype="multipart/form-data"
            style="max-width:800px; margin:0 auto;">

        @csrf

        <div style="margin-bottom:12px;">
        <label>Title</label>
        <input type="text" name="title"
                value="{{ old('title', $post->title) }}"
                style="width:100%; padding:10px;">
        @error('title')
            <div style="color:red;">{{ $message }}</div>
        @enderror
        </div>

        <div style="margin-bottom:12px;">
        <label>Description</label>
        <textarea name="description" rows="6"
                    style="width:100%; padding:10px;">{{ old('description', $post->description) }}</textarea>
        @error('description')
            <div style="color:red;">{{ $message }}</div>
        @enderror
        </div>

        <div style="margin-bottom:12px;">
        <label>Image</label>
        <input type="file" name="image">
        @error('image')
            <div style="color:red;">{{ $message }}</div>
        @enderror

        @if($post->image)
            <div style="margin-top:10px;">
        <img src="{{ asset('img/'.$post->image) }}" width="150">
            </div>
        @endif
        </div>

        <button type="submit" class="newsletter-btn">
        Save Changes
        </button>

        <a href="{{ route('admin.posts.edit.index') }}" style="margin-left:10px;">
        Back
        </a>

    </form>

    @else

        <div class="section-header">
        <h1 class="section-title">Edit Posts</h1>
        <p class="section-subtitle">Choose a post to update</p>
        </div>

        <div class="posts-grid">
        @forelse($posts as $postItem)

        <article class="post-card">

            <div class="post-image-wrapper">
                <img src="{{ asset('img/'.$postItem->image) }}"
                class="post-image"
                alt="{{ $postItem->title }}">
                <span class="post-category">Post</span>
            </div>

            <div class="post-content">
                <h3 class="post-title">{{ $postItem->title }}</h3>
                <p class="post-excerpt">
                {{ Str::limit($postItem->description, 120) }}
                </p>

            
            </div>

        </article>

        @empty
            <p>No posts found.</p>
        @endforelse
    </div>

        <div style="margin-top:20px; text-align:center;">
            {{ $posts->links() }}
        </div>

    @endif

</div>
</section>

@endsection