<?php

namespace App\Http\Controllers;
use App\Models\Profil_Users;

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
}
