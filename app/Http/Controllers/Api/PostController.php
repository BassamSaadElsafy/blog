<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
  
    public function index()
    {
        $data = Post::withTrashed()->paginate(20);
        return ['statusCode' => 200 , 'data' => PostResource::collection($data) ];
    }

   
    public function store(Request $request)
    {
        $valid_usersIDs = implode(',',User::pluck('id')->toArray());

        $request->validate( [

                'title'        => ['required', 'min:3', 'unique:posts'],
                'description'  => ['required', 'min:10'],
                'user_id'      => ['required' ,'in:'.$valid_usersIDs],            //taking string like 1,2,3,.....etc
            
            ],
            [
                'title.required'       => 'you must fill title field',
                'title.min'            => 'post title must be at least 3 characters',
                'description.required' => 'you must fill description field',
                'description.min'      => 'post description must be at least 10 characters',
                'user_id.required'     => 'Post Creator must be selected from the list',
                'user_id.in'           => 'Post Creator is not valid!',
              
            ]
        );

        $data = $request->all();

        Post::create($data);

        return ['statusCode' => 201 , 'statusMessage' => 'Post created successfully' , 'data' => $data];
    }


    public function show($id)
    {
        $data = Post::find($id);
        return ['statusCode'=> 200 ,'data' => new PostResource($data) ];
    }

  
}
