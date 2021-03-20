@extends('posts.layouts.app')

@section('title')
    Edit Post
@endsection


@section('content')

<form action="{{ route('posts.update', ['post' => $post['id']]) }}" method="POST">

  @csrf
  @method('PUT')

  <div class="form-group">
    <label for="title">Title</label>
    <input type="text" class="form-control" id="title" placeholder="post title" value="{{ $post['title'] }}">
  </div>

  <div class="form-group">
    <label for="description">Description</label>
    <textarea class="form-control" id="description" rows="3" placeholder="post description">{{ $post['description'] }}</textarea>
  </div>

  <div class="form-group">
    <label for="post_creator">Post Creator</label>
    <select class="form-control" id="post_creator">
      <option>Saad</option>
      <option selected>Bassam</option>
    </select>
  </div>

  <div class="form-group">

    <input type="submit" class="btn btn-success" value="Edit">

  </div>

  
</form>


@endsection