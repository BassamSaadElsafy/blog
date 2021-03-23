<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Post::withTrashed()->paginate(15);
        return view('posts.index', ['posts' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        return view('posts.create' , compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    
        $valid_usersIDs = implode(',',User::pluck('id')->toArray());
        //validation
        $request->validate([

                'title'        => ['required', 'min:3', 'unique:posts'],
                'description'  => ['required', 'min:10'],
                'user_id'      => ['required' ,'in:'.$valid_usersIDs]            //taking string like 1,2,3,.....etc

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


        Post::create($request->all());

        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Post::find($id);
        return view('posts.show', ['post' => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Post::find($id);
        $users = User::all();
        return view('posts.edit', ['post' => $data, 'users' => $users]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $post_id)
    {

        $valid_usersIDs = implode(',',User::pluck('id')->toArray());

        //validation
        $request->validate([

            'title'        => ['required', 'min:3', 'unique:posts,id,' . $post_id], //ignore unique validation for the post that contains this post_id
            'description'  => ['required', 'min:10'],
            'user_id'      => ['required', 'in:'.$valid_usersIDs]

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


        $post = Post::find($post_id);

        $post->update([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => $request->user_id,
        ]);
       
        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);   
        $post->delete();
        return redirect()->route('posts.index');
        
    }

    //restore post function
    public function restore(Request $request)
    {
        
        Post::withTrashed()
            ->where('id', $request->post_id)
            ->restore();

        return redirect()->route('posts.index');

    }

    public function get_post_response(Request $request)
    {

        $data = Post::withTrashed()->where("id", $request->post)->first();
        return view('posts.show_post_ajax', ['post' => $data]);

    }

}
