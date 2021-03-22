@extends('layouts.app')

@section('title')
    create Post
@endsection


@section('content')

{{-- @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif --}}

<form action="{{ route('posts.store') }}" method="POST">

  @csrf

  <div class="form-group">
    <label for="title">Title</label>
    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="post title">
  

    @error('title')
      <div class="alert alert-danger">{{ $message }}</div>
    @enderror

  
  </div>

  <div class="form-group">
    <label for="description">Description</label>
    <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" rows="3" placeholder="post description"></textarea>
  
    @error('description')
      <div class="alert alert-danger">{{ $message }}</div>
    @enderror
  
  </div>

  <div class="form-group">
    <label for="post_creator">Post Creator</label>
    <select class="form-control" name="user_id" id="post_creator">

      @foreach ($users as $user)
        <option value="{{ $user->id }}">{{ $user->name }}</option>
      @endforeach
      
    </select>
  </div>

  <div class="form-group">

    <input type="submit" class="btn btn-primary" value="create">

  </div>

  
</form>


@endsection