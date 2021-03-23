<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
        $data = $request->validate([

                'title'        => ['required', 'min:3', 'unique:posts'],
                'description'  => ['required', 'min:10'],
                'user_id'      => ['required' ,'in:'.$valid_usersIDs],            //taking string like 1,2,3,.....etc
                'post_img'     => ['required','file','mimes:jpeg,png']            //file or using image for validation images

            ],
            [
                'title.required'       => 'you must fill title field',
                'title.min'            => 'post title must be at least 3 characters',
                'description.required' => 'you must fill description field',
                'description.min'      => 'post description must be at least 10 characters',
                'user_id.required'     => 'Post Creator must be selected from the list',
                'user_id.in'           => 'Post Creator is not valid!',
                'post_img.required'    => 'Post Image is mandatory!',
                'post_img.file'        => 'Post Image must be file!',
                'post_img.mimes'       => 'Post Image must be jpeg or png type!',
            ]
        );



        $data['post_img'] = $request->post_img->getClientOriginalName();
        $request->post_img->storeAs('post_images', $data['post_img']);

        Post::create($data);

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
        $data = $request->validate([

            'title'        => ['required', 'min:3', 'unique:posts,id,' . $post_id], //ignore unique validation for the post that contains this post_id
            'description'  => ['required', 'min:10'],
            'user_id'      => ['required' ,'in:'.$valid_usersIDs],            //taking string like 1,2,3,.....etc
            'post_img'     => ['required','file','mimes:jpeg,png']            //file or using image for validation images

        ],
        [
            'title.required'       => 'you must fill title field',
            'title.min'            => 'post title must be at least 3 characters',
            'description.required' => 'you must fill description field',
            'description.min'      => 'post description must be at least 10 characters',
            'user_id.required'     => 'Post Creator must be selected from the list',
            'user_id.in'           => 'Post Creator is not valid!',
            'post_img.required'    => 'Post Image is mandatory!',
            'post_img.file'        => 'Post Image must be file!',
            'post_img.mimes'       => 'Post Image must be jpeg or png type!',
        ]
    );


        $post = Post::find($post_id);

        //delete old image of post if exist
        if(!empty($post->post_img)){
            Storage::delete('post_images/' . $post->post_img);
        }

        $data['post_img'] = $request->post_img->getClientOriginalName();
        $request->post_img->storeAs('post_images', $data['post_img']);

        $post->update([
            'title'       => $request->title,
            'description' => $request->description,
            'user_id'     => $request->user_id,
            'post_img'    => $data['post_img'],
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
        
        if(!empty($post->post_img)){
            Storage::delete('post_images/' . $post->post_img);
        }
        
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

    //logout function
    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');

    }

}
