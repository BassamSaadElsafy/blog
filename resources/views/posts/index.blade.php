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
            <td>{{ $post->created_at->format('d/m/Y') }}</td>
            <td>

                <x-button type='success btn-sm' href="{{ route('posts.show' , ['post' => $post->id]) }}"> View </x-button>
                <x-button type='primary btn-sm' href="{{ route('posts.edit' , ['post' => $post->id]) }}"> Edit </x-button>

                <button type="button" class="btn btn-warning btn-sm show-ajax" data-toggle="modal" data-target="#ajax_view" data-ajax="{{$post->id}}" style="font-size: 12px; font-weight: bolder">Ajax View</button>

                <!-- Button trigger modal -->

                @if ($post->deleted_at)
                  <form action="{{ route('posts.restore') }}" method="post">
                    @csrf
                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                    <input type="submit"  class="btn btn-default border" value="Restore"/>
  
                  </form>
                @else

                  <a type="button" class="btn btn-danger btn-sm" data-toggle="modal" style="color: white" data-target="#deletePost{{ $post->id }}">
                    X
                  </a>
                    
                @endif
                

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
                          <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">No</button>
                          <input type="submit" class="btn btn-danger btn-sm" value="Yes">
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
{{$posts->links("pagination::bootstrap-4")}}

<div id="ajax_view" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title text-center">Post Details</h4>
        <button type="button" class="close" data-dismiss="modal">×</button>
      </div>
      <div class="modal-body" id="post_content">
        
      </div>
    </div>
  </div>
</div>

@push('js')
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  
  <script>

    $(document).ready(function () {

      $('.show-ajax').click(function () {

        console.log($(this).data('ajax'));

        $.ajax({
            url: '{{ route('posts.ajax_show') }}',
            type: 'get',
            data: {post: $(this).data('ajax')},
            success: function (data) {
              $('#post_content').html(data);
            }
        });

      });

    });

  </script>
@endpush


@endsection