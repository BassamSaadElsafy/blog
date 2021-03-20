@extends('posts.layouts.app')

@section('title')
    All Posts
@endsection

@section('content')


<a href="{{ route('posts.create') }}" class="btn btn-primary">craete post</a>

<hr>

{{-- <x-button type='danger' href="{{ route('posts.show' , 1) }}" name="{{ 'view' }}"></x-button> --}}

<table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Titls</th>
        <th scope="col">Posted By</th>
        <th scope="col">Created At</th>
        <th scope="col">Actions</th>
      </tr>
    </thead>
    <tbody>
      <tr>

        @foreach ($posts as $post)
        
        <th scope="row">{{ $post['id'] }}</th>
            <td>{{ $post['title'] }}</td>
            <td>{{ $post['posted_by'] }}</td>
            <td>{{ $post['created_at'] }}</td>
            <td>

                <x-button type='success' href="{{ route('posts.show' , ['post' => $post['id']]) }}" name="{{ 'view' }}"></x-button>

                <x-button type='primary' href="{{ route('posts.edit' , ['post' => $post['id']]) }}" name="{{ 'edit' }}"></x-button>

                <x-button type='danger' href="#" name="{{ 'delete' }}"></x-button>


                {{-- <a href="{{ route('posts.show', ['post' => $post['id']]) }}" class="btn btn-success">View</a>
                <a href="{{ route('posts.edit', ['post' => $post['id']]) }}" class="btn btn-primary">Edit</a>
                <a href="#" class="btn btn-danger">Delete</a> --}}

            </td>
        </tr>

        @endforeach
 
    </tbody>
  </table>

    
@endsection