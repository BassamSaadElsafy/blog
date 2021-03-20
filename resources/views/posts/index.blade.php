@extends('posts.layouts.app')

@section('content')


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

                <a href="#" class="btn btn-success">View</a>
                <a href="#" class="btn btn-primary">Edit</a>
                <a href="#" class="btn btn-danger">Delete</a>

            </td>
        </tr>

        @endforeach
 
    </tbody>
  </table>

    
@endsection