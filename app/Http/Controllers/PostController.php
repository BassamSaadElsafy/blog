<?php

namespace App\Http\Controllers;

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

        $data = [

            ['id' => 1 , 'title' => 'learn PHP' ,'posted_by' => 'Bassam' , 'created_at' => '2020-01-15',
                'post_creator' => [
                    'name'   => 'Samy',
                    'email'   => 'samy@yahoo.com',
                    'created_at'   => '2021-01-01',
                ]
            ],
            ['id' => 2 , 'title' => 'solid principles' ,'posted_by' => 'Tamer' , 'created_at' => '2019-06-17',
                'post_creator' => [
                    'name'   => 'Taha',
                    'email'   => 'taha@yahoo.com',
                    'created_at'   => '2021-02-07',
                ]    
            ],
            ['id' => 3 , 'title' => 'Design Pattern' ,'posted_by' => 'Sara' , 'created_at' => '2017-05-24',
        
                'post_creator' => [
                    'name'   => 'doaa',
                    'email'   => 'doaa@yahoo.com',
                    'created_at'   => '2020-05-09',
                ]  

            ],
            ['id' => 4 , 'title' => 'learn Java' ,'posted_by' => 'Ali' , 'created_at' => '2010-08-28',
        
                'post_creator' => [
                    'name'   => 'yasser',
                    'email'   => 'yasser@yahoo.com',
                    'created_at'   => '2020-10-18',
                ]  

            ]

        ];

        return view('posts.index', ['posts' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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

        $data = 

            ['id' => 1 , 'title' => 'learn PHP' ,'description' => 'this is my lovely language' ,'posted_by' => 'Bassam' , 'created_at' => '2020-01-15',
                'post_creator' => [
                    'name'   => 'Bassam',
                    'email'   => 'bassam@yahoo.com',
                    'created_at'   => '2021-01-01',
                ]
            ]
        ;

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
        $data = 

            ['id' => 1 , 'title' => 'learn PHP' ,'description' => 'this is my lovely language' ,'posted_by' => 'Bassam' , 'created_at' => '2020-01-15',
                'post_creator' => [
                    'name'   => 'Bassam',
                    'email'   => 'bassam@yahoo.com',
                    'created_at'   => '2021-01-01',
                ]
            ]
        ;

        return view('posts.edit', ['post' => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    
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
        //
    }
}
