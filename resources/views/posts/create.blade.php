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

<form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">

  @csrf

  <div class="form-group">
    <label for="title">Title</label>
    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="post title" value="{{ old('title') }}">
  

    @error('title')
      <div class="text-danger">{{ $message }}</div>
    @enderror

  
  </div>

  <div class="form-group">
    <label for="description">Description</label>
    <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" rows="3" placeholder="post description">{{ old('description') }}</textarea>
    
    @error('description')
      <div class="text-danger">{{ $message }}</div>
    @enderror
  
  </div>

  <div class="form-group">
    <label for="exampleFormControlFile1">Post Image</label>
    <input type="file" name="post_img" class="form-control-file @error('post_img') is-invalid @enderror" id="exampleFormControlFile1">
    @error('post_img')
      <div class="text-danger">{{ $message }}</div>
    @enderror
  </div>

  <div class="form-group">
    <label for="post_creator">Post Creator</label>
    <select class="form-control @error('user_id') is-invalid @enderror" name="user_id" id="post_creator">

      @foreach ($users as $user)
        <option value="{{ $user->id }}">{{ $user->name }}</option>
      @endforeach
      
    </select>
    @error('user_id')
      <div class="text-danger">{{ $message }}</div>
    @enderror
  </div>

  <div class="form-group">

    <input type="submit" class="btn btn-primary" value="create">

  </div>

  
</form>


@endsection