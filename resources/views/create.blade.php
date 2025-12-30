@extends('layouts.app')

@section('title','Create Post')

@section('content')

<section class="blog-grid">
<div class="container-small">

    <h1>Create New Post</h1>
    <p>Share your thoughts</p>

    <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
    @csrf

        <div>
            <label>Title</label><br>
            <input type="text" name="title" required>
        </div>

    <br>

    <div>
        <label>Description</label><br>
        <textarea name="description" rows="6" required></textarea>
    </div>

    <br>

    <div>
        <label>Image</label><br>
        <input type="file" name="image">
    </div>

    <br>

    <button type="submit">Publish</button>
    <a href="{{ route('blog') }}">Cancel</a>

    </form>

</div>
</section>

@endsection