@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<section class="blog-grid" style="padding-top:6rem;">
    <div class="container container-small">

        <div class="section-header">
            <h1 class="section-title">Dashboard</h1>
            <p class="section-subtitle">
                @if(auth()->user()->usertype === 'admin')
                    Manage your posts from here.
                @else
                    You are logged in.
                @endif
            </p>
        </div>

        @if(auth()->user()->usertype === 'admin')
            <div class="dash-grid">
                <a class="dash-card" href="{{ route('admin.posts.edit.index') }}">
                    <div class="dash-card-title">Edit Posts</div>
                    <div class="dash-card-sub">Update titles, descriptions, and images.</div>
                    <div class="dash-card-cta">Open →</div>
                </a>

                <a class="dash-card dash-card-danger" href="{{ route('admin.posts.delete.index') }}">
                    <div class="dash-card-title">Delete Posts</div>
                    <div class="dash-card-sub">Remove posts carefully (cannot be undone).</div>
                    <div class="dash-card-cta">Open →</div>
                </a>
            </div>
        @else
            <div class="post-card" style="padding:18px;">
                You're logged in as a user.
            </div>
        @endif

    </div>
</section>
@endsection
