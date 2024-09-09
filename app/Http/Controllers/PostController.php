<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostDetailResource;
use App\Http\Resources\PostResource;

use App\Models\post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function posts()
    {
        $posts = post::all();
        return PostResource::collection($posts);
    }
    public function post($id)
    {
        $post = post::findorfail($id);
        return new PostDetailResource($post);
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        // Merge user_id into the request data
        $data = $request->all();
        $data['user_id'] = $request->user()->id;

        // Create the post
        $post = Post::create($data);

        // Return the newly created post as a resource
        return new PostResource($post);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);
        $post = post::findorfail($id);
        $post->update($request->all());
        return new PostResource($post);
    }
    public function destroy($id)
    {
        $post = post::findorfail($id);
        $post->delete();
        return response()->json(['message' => 'Post deleted successfully'], 200);
    }
}
