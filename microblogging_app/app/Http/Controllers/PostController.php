<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('user')->get();
        return response()->json($posts);
    }

    public function store(Request $request)
    {
        $post = Post::create([
            'titre' => $request->titre,
            'description' => $request->description,
            'user_id' => $request->user_id,
        ]);

        return response()->json($post->load('user'));
    }

    public function show($id)
    {
        $post = Post::with('user')->findOrFail($id);
        if(!empty($post)){
            return response()->json($post);}
        else{
            return response()->json(['message' => 'post introuvable'],404);
        }
    }

    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $post->update([
            'titre' => $request->titre,
            'description' => $request->description,
            'hashtags' => $request->hashtags,
        ]);
        return response()->json($post->load('user'));
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return response()->json(['message' => 'Post supprimé']);
    }
}
