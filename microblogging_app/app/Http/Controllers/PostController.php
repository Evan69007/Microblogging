<?php

namespace App\Http\Controllers;
use App\Models\Post;

use Illuminate\Http\Request;

class PostController extends Controller
{

    public function index()
         {
            // Fetch all Meubles with their photos
            $post = Post::with('user')->get();
            // dd(asset("storage/photos/Table-1.png"));
            return response()->json($post);
         }
}
