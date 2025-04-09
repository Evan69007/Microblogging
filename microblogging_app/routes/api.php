<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfilUsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


Route::get("/Users", [UserController::class, 'index']);
Route::get("/Profil", [ProfilUsersController::class, 'index']);
Route::get("/Posts", [PostController::class, 'index']);
