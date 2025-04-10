<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserController extends Controller
{
    public function index()
    {
        // Fetch all Meubles with their photos
        $users = User::with(['likes', 'post','profil_Users'])->get();
        // dd(asset("storage/photos/Table-1.png"));
        return response()->json($users);
    }

    public function store(Request $request)
    {
       $user = new User();
       $user->name = $request->name;
       $user->email = $request->email;
       $user->password = Hash::make($request->password);
       $user->created_at = Carbon::now()->toDateTimeString();
       $user->save();

       return response()->json(['message' => 'User ajoute'],200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       $user = User::with(['likes', 'post','profil_Users'])->findOrFail($id);
       if(!empty($user)){
        return response()->json($user);}
       else{
        return response()->json(['message' => 'User introuvable'],404);
       }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if(User::where('id', $id)->exists()){
            $user = User::find($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->updated_at = Carbon::now()->toDateTimeString();
            $user->save();
            return response()->json(['message' => 'User modifie'],200);
        }else{
            return response()->json(['message' => 'User introuvable'],404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(User::where('id', $id)->exists()){
            $user = User::find($id);
            $user->delete();
            return response()->json(['message' => 'User supprimé']);
        }else{
            return response()->json(['message' => 'User introuvable'],404);
        }
    }
}



