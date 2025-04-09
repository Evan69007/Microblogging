<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        // Fetch all Meubles with their photos
        $users = User::with('post')->get();
        // dd(asset("storage/photos/Table-1.png"));
        return response()->json($users);
    }
}

