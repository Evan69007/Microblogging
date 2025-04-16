<?php

namespace App\Http\Controllers;
use App\Models\Likes;

use Illuminate\Http\Request;

class LikesController extends Controller
{
    public function index()
    {
        $Likes = Likes::with(['user', 'post'])->get();
        return response()->json($Likes);
    }

	public function store(Request $request)
    {
		$Likes = new Likes();
		$Likes->user_id = $request->user_id;
		$Likes->post_id = $request->post_id;
		$Likes->save();
	
		return response()->json(['message' => 'Like ajoute'],200);
    }

         /**
          * Display the specified resource.
          */
    public function show(string $id)
    {
        $Likes = Likes::with(['user', 'post'])->findOrFail($id);
        if(!empty($Likes)){
            return response()->json($Likes);}
        else{
            return response()->json(['message' => 'Like introuvable'],404);
        }
    }

         /**
          * Update the specified resource in storage.
          */
    public function update(Request $request, string $id)
    {
        if(Likes::where('id', $id)->exists()){
            $Likes = Likes::find($id);
            $Likes->user_id = $request->user_id;
            $Likes->post_id = $request->post_id;
            $Likes->save();
            return response()->json(['message' => 'Like modifié'],200);
        }else{
            return response()->json(['message' => 'Like introuvable'],404);
        }
    }

         /**
          * Remove the specified resource from storage.
          */
    public function destroy(string $id)
    {
        if(Likes::where('post_id', $id)->exists()){
            $Likes = Likes::where('post_id', $id)->first();
            $Likes->delete();
            return response()->json(['message' => 'Like supprimé']);
        }else{
            return response()->json(['message' => 'Like introuvable'],404);
		}
    }
}
