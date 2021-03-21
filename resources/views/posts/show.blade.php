@extends('layouts.app')

@section('title')
    Show Post
@endsection


@section('content')


<div class="card">
  <div class="card-header">
    Post Information
  </div>
  <div class="card-body">

    <h5 class="card-title">Post Title</h5>
    <p class="card-text">{{ $post->title }}</p>

    <h5 class="card-title">Post Description</h5>
    <p class="card-text">{{ $post->description}}</p>

  </div>
</div>

<hr>


<div class="card">
  <div class="card-header">
    Post Creator
  </div>
  <div class="card-body">

    <h5 class="card-title">Name</h5>
    <p class="card-text">{{ $post->title }}</p>

    <h5 class="card-title">E-mail</h5>
    <p class="card-text">{{ $post->user->email }}</p>

    <h5 class="card-title">Created At</h5>
    {{-- {{ $post->user->created_at }} --}}
    {{-- <p class="card-text">  {{ \Carbon\Carbon::parse($post->user->created_at, 'd/m/Y H:i:s')->format('l, F j, Y') }}</p>
    <p class="card-text">  {{ \Carbon\Carbon::parse($post->user->created_at, 'd/m/Y H:i:s')->format('Y-m-d\TH:i:s.uP') }}</p> --}}
    <p class="card-text">  {{ \Carbon\Carbon::parse($post->user->created_at, 'd/m/Y H:i:s')->isoFormat('ddd  Do  \of MMMM YYYY, h:mm:ss a') }}</p>

    
    

  </div>
</div>


@endsection