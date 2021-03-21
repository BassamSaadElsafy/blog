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
        <th scope="col">Description</th>
        <th scope="col">Posted By</th>
        <th scope="col">Created At</th>
        <th scope="col">Actions</th>
      </tr>
    </thead>
    <tbody>
      <tr>

        @foreach ($posts as $post)
        
        <th scope="row">{{ $post->id }}</th>
            <td>{{ $post->title }}</td>
            <td>{{ $post->description }}</td>
            <td>{{ $post->user->name }}</td>
            <td>{{ $post->created_at }}</td>
            <td>

                <x-button type='success' href="{{ route('posts.show' , ['post' => $post->id]) }}" >View</x-button>
                <x-button type='primary' href="{{ route('posts.edit' , ['post' => $post->id]) }}">Edit</x-button>
                {{-- <x-button type='danger' href="#" name="{{ 'delete' }}">Delete</x-button> --}}

                <!-- Button trigger modal -->
                <a type="button" class="btn btn-danger" data-toggle="modal" style="color: white" data-target="#deletePost{{ $post->id }}">
                  Delete
                </a>

                <!-- Modal -->
                <div class="modal fade" id="deletePost{{ $post->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Warning</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">    
                          <b>Are you sure that you want to delete this Post {{ $post->title }}?</b>
                      </div>

                      <form action="{{ route('posts.destroy', [ 'post' => $post->id ]) }}" method="post">
                        
                        @csrf
                        @method('delete')
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                          <input type="submit" class="btn btn-danger btn-sm" value="Delete">
                        </div>

                      </form>
                      
                    </div>
                  </div>
                </div>




            </td>
        </tr>

        @endforeach
 
    </tbody>
  </table>

  {{ $posts->links() }}
  
    
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
@endsection