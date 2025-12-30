@extends('layouts.app')

@section('title','Get Started')

@section('content')

<section class="landing">

    <div class="landing-inner">

        <p class="landing-badge">Pluto Blog</p>

        <h1>Welcome to the Pluto Blog</h1>

        <p>
            This is a simple blog where you can write posts
            and read other posts easily.
        </p>

        <div class="landing-actions">
            <a href="{{ route('home') }}" class="btn btn-primary">
                Get Started
            </a>

            <a href="{{ route('login') }}" class="btn btn-ghost">
                Login
            </a>
        </div>

        <div class="landing-stats">

            <div class="stat">
                <strong>Fast</strong>
                <p>Simple design</p>
            </div>

            <div class="stat">
                <strong>Clean</strong>
                <p>No distractions</p>
            </div>

            <div class="stat">
                <strong>Easy</strong>
                <p>Manage posts</p>
            </div>

        </div>

    </div>

</section>

@endsection