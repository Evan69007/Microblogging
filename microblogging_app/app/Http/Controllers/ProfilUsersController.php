<?php

namespace App\Http\Controllers;
use App\Models\Profil_Users;
use Carbon\Carbon;

use Illuminate\Http\Request;

class ProfilUsersController extends Controller
{
    public function index()
         {
            // Fetch all Meubles with their photos
            $profilusers = Profil_Users::with('user')->get();
            // dd(asset("storage/photos/Table-1.png"));
            return response()->json($profilusers);
         }

         public function store(Request $request)
         {
            $Profil_Users = new Profil_Users();
            $Profil_Users->user_id = $request->user_id;
            if(!empty($request->biographie))
            {
                $Profil_Users->biographie = $request->biographie;
            }
            else{
                $Profil_Users->biographie = "";
            }
            $Profil_Users->created_at = Carbon::now()->toDateTimeString();
            $Profil_Users->save();

            return response()->json(['message' => 'Profil_Users ajoute'],200);
         }

         /**
          * Display the specified resource.
          */
         public function show(string $id)
         {
            $Profil_Users = Profil_Users::with('user')->where('user_id', $id)->first();
            if(!empty($Profil_Users)){
             return response()->json($Profil_Users);}
            else{
             return response()->json(['message' => 'Profil_Users introuvable'],404);
            }
         }

         /**
          * Update the specified resource in storage.
          */
         public function update(Request $request, string $id)
         {
             if(Profil_Users::where('id', $id)->exists()){
                 $Profil_Users = Profil_Users::find($id);
                 $Profil_Users->user_id = $request->user_id;
                $Profil_Users->biographie = $request->biographie;
                 $Profil_Users->updated_at = Carbon::now()->toDateTimeString();
                 $Profil_Users->save();
                 return response()->json(['message' => 'Profil_Users modifie'],200);
             }else{
                 return response()->json(['message' => 'Profil_Users introuvable'],404);
             }
         }

         /**
          * Remove the specified resource from storage.
          */
         public function destroy(string $id)
         {
             if(Profil_Users::where('id', $id)->exists()){
                 $Profil_Users = Profil_Users::find($id);
                 $Profil_Users->delete();
                 return response()->json(['message' => 'Profil_Users supprimé']);
             }else{
                 return response()->json(['message' => 'Profil_Users introuvable'],404);
             }
         }
}
