<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfilUsersController;
use App\Http\Controllers\LikesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


Route::get("/Users", [UserController::class, 'index']);



Route::get("/Posts", [PostController::class, 'index']);
Route::post("/Posts", [PostController::class, 'store']);
Route::get("/Posts/{id}", [PostController::class, 'show']);
Route::put("/Posts/{id}", [PostController::class, 'update']);
Route::delete("/Posts/{id}", [PostController::class, 'destroy']);

Route::get("/Profil_Users", [ProfilUsersController::class, 'index']);
Route::post("/Profil_Users", [ProfilUsersController::class, 'store']);
Route::get("/Profil_Users/{id}", [ProfilUsersController::class, 'show']);
Route::put("/Profil_Users/{id}", [ProfilUsersController::class, 'update']);
Route::delete("/Profil_Users/{id}", [ProfilUsersController::class, 'destroy']);


Route::get("/likes", [LikesController::class, 'index']);
Route::post("/likes", [LikesController::class, 'store']);
Route::get("/likes/{id}", [LikesController::class, 'show']);
Route::put("/likes/{id}", [LikesController::class, 'update']);
Route::delete("/likes/{id}", [LikesController::class, 'destroy']);

