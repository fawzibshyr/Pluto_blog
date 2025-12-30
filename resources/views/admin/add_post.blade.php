@extends('layouts.app')
@section('title','Add Post')

@push('styles')
<link rel="stylesheet" href="{{ asset('CSS/addpost.css') }}">
@endpush

@section('content')

<div class="toast" id="toast">Saved</div>

<main class="page">
<div class="shell">

<section class="cover" id="coverBox">

<input type="file" id="image" name="image" hidden form="postForm" accept="image/*">

<div id="coverEmpty" class="cover-empty">
  <div class="cover-icon">⬆</div>
  <div class="cover-title">Add a cover image</div>
  <div class="cover-sub">
    Drag & drop or
    <button type="button" class="link" id="pickImg">browse</button>
  </div>
</div>

<div id="coverFilled" class="cover-filled" style="display:none;">
  <img id="coverImg">
  <div class="cover-actions">
    <button type="button" class="btn ghost" id="changeImg">Change</button>
    <button type="button" class="btn ghost danger" id="removeImg">Remove</button>
  </div>
</div>

</section>

<section class="editor">

<form id="postForm" method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
@csrf

<input type="text" name="title" id="title" class="title" placeholder="Write a great title…" required>

<div class="row">

<div class="field">
<label>Topic</label>
<select name="topic" id="topic">
  <option>Laravel</option>
  <option>Python</option>
  <option>CSS</option>
  <option>HTML</option>
  <option>php</option>
  <option>sql</option>
  <option>DevOps</option>
</select>
</div>

<div class="field">
<label>Slug</label>
<div class="slug-row">
  <input type="text" name="slug" id="slug" placeholder="auto-generated">
  <button type="button" class="btn ghost mini" id="genSlug">Generate</button>
</div>
</div>

</div>

<div class="field">
<label>Tags</label>
<div class="tags">
  <input type="text" id="tagInput" placeholder="Type a tag and press Enter">
</div> 

<div class="field">
<label>Content</label>
<textarea name="description" id="content" class="content" rows="10" placeholder="Start writing…"></textarea>
<div class="hint">Tip: short paragraphs look premium.</div>
</div>

<div class="footer">
<div id="footNote" class="foot-note">No cover image yet</div>

<div class="footer-actions">
<button type="button" class="btn ghost" id="draftBtn2">Save Draft</button>
<button type="submit" class="btn primary">Publish</button>
</div>
</div>

</form>

</section>

</div>
</main>

@push('scripts')
<script src="{{ asset('JS/addpost.js') }}"></script>
@endpush

@endsection
