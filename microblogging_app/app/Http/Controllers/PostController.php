<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Carbon\Carbon;

use Illuminate\Http\Request;

class PostController extends Controller
{

    public function index()
         {
            // Fetch all Posts with their photos
            $post = Post::with('user')->get();
            // dd(asset("storage/photos/Table-1.png"));
            return response()->json($post);
         }

         public function store(Request $request)
         {
            $Post = new Post();
            $Post->user_id = $request->user_id;
            $Post->titre = $request->titre;
            $Post->description = $request->description;
            $Post->hashtags = $request->hashtags;
            $Post->created_at = Carbon::now()->toDateTimeString();
            $Post->save();

            return response()->json(['message' => 'Post ajoute'],200);
         }

         /**
          * Display the specified resource.
          */
         public function show(string $id)
         {
            $Post = Post::with('user')->findOrFail($id);
            if(!empty($Post)){
             return response()->json($Post);}
            else{
             return response()->json(['message' => 'Post introuvable'],404);
            }
         }

         /**
          * Update the specified resource in storage.
          */
         public function update(Request $request, string $id)
         {
             if(Post::where('id', $id)->exists()){
                 $Post = Post::find($id);
                 $Post->user_id = $request->user_id;
                 $Post->titre = $request->titre;
                 $Post->description = $request->description;
                 $Post->hashtags = $request->hashtags;
                 $Post->updated_at = Carbon::now()->toDateTimeString();
                 $Post->save();
                 return response()->json(['message' => 'Post modifie'],200);
             }else{
                 return response()->json(['message' => 'Post introuvable'],404);
             }
         }

         /**
          * Remove the specified resource from storage.
          */
         public function destroy(string $id)
         {
             if(Post::where('id', $id)->exists()){
                 $Post = Post::find($id);
                 $Post->delete();
                 return response()->json(['message' => 'Post supprimé']);
             }else{
                 return response()->json(['message' => 'Post introuvable'],404);
             }
         }
     }

