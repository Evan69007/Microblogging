<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfilUsersController;
use App\Http\Controllers\CommentairesController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


Route::get("/Users", [UserController::class, 'index']);
Route::get("/Profil", [ProfilUsersController::class, 'index']);


Route::get("/Posts", [PostController::class, 'index']);
Route::post("/Posts", [PostController::class, 'store']);
Route::get("/Posts/{id}", [PostController::class, 'show']);
Route::put("/Posts/{id}", [PostController::class, 'update']);
Route::delete("/Posts/{id}", [PostController::class, 'destroy']);

Route::get("/Commentaires", [CommentairesController::class, 'index']);
Route::post("/Commentaires", [CommentairesController::class, 'store']);
Route::get("/Commentaires/{id}", [CommentairesController::class, 'show']);
Route::put("/Commentaires/{id}", [CommentairesController::class, 'update']);
Route::delete("/Commentaires/{id}", [CommentairesController::class, 'destroy']);
