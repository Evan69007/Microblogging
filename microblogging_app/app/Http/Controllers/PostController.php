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
            'user_id' => auth()->id()
        ]);

        return response()->json($post->load('user'));
    }

    public function show(Post $post)
    {
        return response()->json($post->load('user'));
    }

    public function update(Request $request, Post $post)
    {
        $post->update([
            'titre' => $request->titre,
            'description' => $request->description
        ]);

        return response()->json($post->load('user'));
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return response()->json(['message' => 'Post supprimé']);
    }
}
