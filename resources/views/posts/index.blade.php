@extends('layouts.app')

@section('title')
    All Posts
@endsection

@section('content')

<x-button type='primary' href="{{ route('posts.create') }}" >Create Post</x-button>

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

                <x-button type='success' href="{{ route('posts.show' , ['post' => $post['id']]) }}" >View</x-button>
                <x-button type='primary' href="{{ route('posts.edit' , ['post' => $post['id']]) }}">Edit</x-button>
                <x-button type='danger' href="#" name="{{ 'delete' }}">Delete</x-button>

            </td>
        </tr>

        @endforeach
 
    </tbody>
  </table>

    
@endsection