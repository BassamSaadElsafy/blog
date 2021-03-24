<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
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
    public function store(PostRequest $request)
    {
    
        $data = $request->all();

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
    public function update(PostRequest $request, Post $post)
    {

        $data = $post->toArray();

        //delete old image of post if exist
        if(!empty($post->post_img)){
            Storage::delete('post_images/' . $post->post_img);
        }

        if(!empty($request->post_img)){
            $data['post_img'] = $request->post_img->getClientOriginalName();
            $request->post_img->storeAs('post_images', $data['post_img']);
        }
    
        $post->update($data);
       
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
