@extends('posts.layouts.app')

@section('title')
    create Post
@endsection


@section('content')

<form action="{{ route('posts.store') }}" method="POST">

  @csrf

  <div class="form-group">
    <label for="title">Title</label>
    <input type="text" class="form-control" id="title" placeholder="post title">
  </div>

  <div class="form-group">
    <label for="description">Description</label>
    <textarea class="form-control" id="description" rows="3" placeholder="post description"></textarea>
  </div>

  <div class="form-group">
    <label for="post_creator">Post Creator</label>
    <select class="form-control" id="post_creator">
      <option>Bassam</option>
      <option>Saad</option>
    </select>
  </div>

  <div class="form-group">

    <input type="submit" class="btn btn-primary" value="create">

  </div>

  
</form>


@endsection