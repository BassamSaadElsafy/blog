<div class="card bg-light">

    <div class="card-body">
      <h5 class="card-title text-muted">Title:</h5>
      <p class="card-text"><b>{{$post->title}}</b></p>
      <h5 class="card-title text-muted">Description:</h5>
      <p class="card-text"><b>{{$post->description}}</b></p>
      <hr>
      <h5 class="card-title text-success">Posted by:</h5>
      <p class="card-text">Name: <b>{{ $post->user->name }}</b></p>
      <p class="card-text">E-mail: <b>{{ $post->user->email }}</b></p>
      <p class="card-text">Created at: <b>{{ $post->human_readable_date($post->created_at) }}</b></p>
    </div>
    
 </div>