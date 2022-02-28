<?php

namespace App\Http\Controllers;

use App\Http\Resources\CommentResource;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $posts = Comment::all();
        return CommentResource::collection($posts);
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
     * @return CommentResource
     */
    public function store(Request $request): CommentResource
    {
        $comment = new Comment();
        $comment->content = $request->body;
        $comment->user_id = $request->user_id;
        $comment->img = $request->img;
        $comment->post_id = $request->post_id;
        if($comment->save()){
            return new  CommentResource($comment);
        }
        return  abort(404);
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return CommentResource
     */
    public function show($id): CommentResource
    {
        $comment = Comment::findOrFail($id);
        return new CommentResource($comment);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Comment $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $id
     * @return CommentResource
     */
    public function update(Request $request, $id): CommentResource
    {
        $comment = Comment::findOrFail($id);
        $comment->content = $request->body;
        $comment->img = $request->img;
        if($comment->save()){
            return  new CommentResource($comment);
        }
        return abort(404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return CommentResource
     */
    public function destroy($id): CommentResource
    {
        $comment = Comment::findOrFail($id);
        if ($comment->delete()){
            return new CommentResource($comment);
        }
        return abort(404);
    }
}
