<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $posts = Post::with('comments')->get()->toArray();
        return PostResource::collection($posts);
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
     * @param Request $request
     * @return PostResource
     */
    public function store(Request $request)
    {
        $post = new Post();
        $post->content = $request->body;
        $post->user_id = $request->user_id;
        $post->img = $request->img;
        if($post->save()){
            return new  PostResource($post);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return PostResource
     */
    public function show($id): PostResource
    {
        $post = Post::where('id',$id)->with('comments')->get()->toArray();
        return new PostResource($post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Post $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $id
     * @return PostResource
     */
    public function update(Request $request, $id): PostResource
    {
        $post = Post::findOrFail($id);
        $post->content = $request->body;
        $post->img = $request->img;
        if($post->save()){
            return  new PostResource($post);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return PostResource
     */
    public function destroy($id): PostResource
    {
        $post = Post::findOrFail($id);
        if ($post->delete()){
            return new PostResource($post);
        }
    }
}
