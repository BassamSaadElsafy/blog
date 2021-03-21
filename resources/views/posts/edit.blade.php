@extends('layouts.app')

@section('title')
    Edit Post
@endsection


@section('content')

<form action="{{ route('posts.update', ['post' => $post->id]) }}" method="POST">

  @csrf
  @method('PUT')

  <div class="form-group">
    <label for="title">Title</label>
    <input type="text" class="form-control" name="title" id="title" placeholder="post title" value="{{ $post->title }}">
  </div>

  <div class="form-group">
    <label for="description">Description</label>
    <textarea class="form-control" id="description" name="description" rows="3" placeholder="post description">{{ $post->description }}</textarea>
  </div>

  <div class="form-group">
    <label for="post_creator">Post Creator</label>
    <select class="form-control" id="user_id" name="user_id">
      @foreach ($users as $user)
        <option value="{{ $user->id }}" {{  ($user->id == $post->user_id) ?  'selected' : '' }}>{{ $user->name }}</option>
      @endforeach
    </select>
  </div>

  <div class="form-group">

    <input type="submit" class="btn btn-success" value="Edit">

  </div>

  
</form>


@endsection