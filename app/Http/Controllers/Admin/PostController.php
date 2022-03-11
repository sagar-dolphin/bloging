<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Requests\AddPostRequest;
use App\Services\PostService;

class PostController extends Controller
{
    protected Post $post;
    protected PostService $postService;

    public function __construct(Post $post, PostService $postService)
    {  
        $this->post = $post;
        $this->postService = $postService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PostService $postService, Request $request)
    {
        if($request->ajax()){
            return $postService->getDataTable($request);
        }
        return view('admin.posts.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddPostRequest $request, PostService $postService)
    {
        if($request->ajax() && $request->validated()){
            try {
                $post = $request->all();
                if($request->hasfile('image')){
                    $post['image'] = $postService->handleImage($request->file('image'));
                }
                $post = Post::create($post);
                return response()->json([
                    'success' => true,  
                    'title' => 'Post',
                    'message' => 'successfully created!',
                ]);
            } catch (\Exception $e) {
                return response()->json([
                    'success' => false,  
                    'title' => 'Post',
                    'message' => 'something went wrong!',
                ]);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
