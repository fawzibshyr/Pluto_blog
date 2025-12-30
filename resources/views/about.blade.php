@extends('layouts.app')

@section('title', 'About')

@push('styles')
<link rel="stylesheet" href="{{ asset('CSS/about.css') }}">
@endpush

@section('content')

<section class="about">
  <div class="about__container">

  
    <div class="about__text">
      <h1>My story</h1>

      <p class="subtitle">A simple programming journey</p>

      <p>
        I'm Fawzi, a programming student who started learning coding less than nine months ago.
        This blog is my first real project, where I apply what I learn and turn ideas into real features.
      </p>

      <p>
        I focus on learning programming through practice — writing code,
        solving problems, and building web applications step by step.
      </p>

      <p>
        This space documents my journey, my progress, and the lessons I learn along the way.
      </p>

      <p>
        I believe real growth in programming comes from building, experimenting, and never stopping learning.
      </p>
    </div>


    <div class="about__image">
      <img
        src="https://images.unsplash.com/photo-1515879218367-8466d910aaa4?auto=format&fit=crop&w=1400&q=75"
        alt="Programming workspace"
      >
    </div>

  </div>
</section>

@endsection