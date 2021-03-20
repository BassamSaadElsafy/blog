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
    <p class="card-text">{{ $post['title'] }}</p>

    <h5 class="card-title">Post Description</h5>
    <p class="card-text">{{ $post['description'] }}</p>

  </div>
</div>

<hr>


<div class="card">
  <div class="card-header">
    Post Creator
  </div>
  <div class="card-body">

    <h5 class="card-title">Name</h5>
    <p class="card-text">{{ $post['title'] }}</p>

    <h5 class="card-title">E-mail</h5>
    <p class="card-text">{{ $post['post_creator']['email'] }}</p>

    <h5 class="card-title">Created At</h5>
    <p class="card-text">{{ $post['created_at'] }}</p>

  </div>
</div>


@endsection