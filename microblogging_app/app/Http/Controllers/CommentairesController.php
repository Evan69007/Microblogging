<?php

namespace App\Http\Controllers;
use App\Models\Commentaires;

use Illuminate\Http\Request;
use Carbon\Carbon;

class CommentairesController extends Controller
{
        public function index()
         {
            // Fetch all commentaires with their photos
            $commentaire = Commentaires::with('user')->get();
            // dd(asset("storage/photos/Table-1.png"));
            return response()->json($commentaire);
         }

         public function store(Request $request)
         {
            $commentaire = new Commentaires();
            $commentaire->user_id = $request->user_id;
            $commentaire->post_id = $request->post_id;
            $commentaire->description = $request->description;
          
            $commentaire->created_at = Carbon::now()->toDateTimeString();
            $commentaire->save();

            return response()->json(['message' => 'commentaire ajoute'],200);
         }

         /**
          * Display the specified resource.
          */
         public function show(string $id)
         {
            $commentaire = Commentaires::with('user')->findOrFail($id);
            if(!empty($commentaire)){
             return response()->json($commentaire);}
            else{
             return response()->json(['message' => 'commentaire introuvable'],404);
            }
         }

         /**
          * Update the specified resource in storage.
          */
         public function update(Request $request, string $id)
         {
             if(Commentaires::where('id', $id)->exists()){
                 $commentaire = Commentaires::find($id);
                 $commentaire->user_id = $request->user_id;
                 $commentaire->post_id = $request->post_id;
                 $commentaire->description = $request->description;
                 
                 $commentaire->updated_at = Carbon::now()->toDateTimeString();
                 $commentaire->save();
                 return response()->json(['message' => 'commentaire modifie'],200);
             }else{
                 return response()->json(['message' => 'commentaire introuvable'],404);
             }
         }

         /**
          * Remove the specified resource from storage.
          */
         public function destroy(string $id)
         {
             if(Commentaires::where('id', $id)->exists()){
                 $commentaire = Commentaires::find($id);
                 $commentaire->delete();
                 return response()->json(['message' => 'commentaire supprimé']);
             }else{
                 return response()->json(['message' => 'commentaire introuvable'],404);
             }
         }
     }



