<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfilUsersController;
use App\Http\Controllers\CommentairesController;
use App\Http\Controllers\LikesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

// Route pour l'inscription d'un nouvel utilisateur
Route::post('/register', function (Request $request) {
  // Validation des données entrantes
 
  try {
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:6',
    ]);
    
    $newUser = User::create([
        'name' => $validatedData['name'],
        'email' => $validatedData['email'],
        'password' => Hash::make($validatedData['password']),
    ]);
    
    // Return success response
} catch (\Exception $e) {
    // Log the error or return it in the response
    return response()->json(['error' => $e->getMessage()], 500);
}

  // Création d'un token d'accès pour l'utilisateur
  $token = $newUser->createToken('auth_token')->plainTextToken;

  // Retourner l'utilisateur créé avec son token
  return response()->json([
      'user' => $newUser,
      'access_token' => $token,
      'token_type' => 'Bearer',
  ], 201);
});

// Route pour la connexion d'un utilisateur
Route::post('/login', function (Request $request) {
  // Vérification que les données sont bien envoyées
  if (!$request->has(['email', 'password'])) {
      return response()->json(['message' => 'Email and password are required'], 400);
  }

  // Validation des données de connexion
  $credentials = $request->only('email', 'password');

  // Tentative d'authentification
  if (!Auth::attempt($credentials)) {
      return response()->json(['message' => 'Unauthorized'], 401);
  }

  // Récupération de l'utilisateur et génération du token
  $user = Auth::user();
  $token = $user->createToken('auth_token')->plainTextToken;

  return response()->json([
      'access_token' => $token,
      'token_type' => 'Bearer',
  ]);
});

//Route pour modifier un utilisateur
Route::middleware('auth:sanctum')->put('/user/update', function (Request $request) {
  // Récupérer l'utilisateur authentifié
  $user = $request->user();

  // Vérifier si des données sont envoyées
  if (!$request->hasAny(['name', 'email', 'biographie', 'password'])) {
      return response()->json(['message' => 'No data to update'], 400);
  }

  // Valider les données
  try {
      $validatedData = $request->validate([
          'name' => 'sometimes|string|max:255',
          'email' => 'sometimes|string|email|max:255|unique:users,email,' . $user->id,
          'biographie' => 'sometimes|string|max:1000',  // Validation pour la biographie
          'password' => 'sometimes|string|min:6'
      ]);
  } catch (\Illuminate\Validation\ValidationException $e) {
      return response()->json(['message' => 'Validation failed', 'errors' => $e->errors()], 422);
  }

  // Mise à jour des données
  if (isset($validatedData['name'])) {
      $user->name = $validatedData['name'];
  }
  if (isset($validatedData['email'])) {
      $user->email = $validatedData['email'];
  }
  if (isset($validatedData['biographie'])) {  // Mise à jour de la biographie
    $user->biographie = $validatedData['biographie'];
}
  if (isset($validatedData['password'])) {
      $user->password = Hash::make($validatedData['password']);
  }
  $user->save();

  return response()->json(['message' => 'User updated successfully', 'user' => $user]);
});

// Route pour la déconnexion d'un utilisateur
Route::middleware('auth:sanctum')->post('/logout', function (Request $request) {

  // Suppression des tokens de l'utilisateur
  $request->user()->tokens()->delete();

  return response()->json(['message' => 'User disconnected'], 200);
});

// Route pour récupérer les informations de l'utilisateur authentifié
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
  return response()->json($request->user());
});




// Cette ligne génère automatiquement toutes les routes REST pour posts
Route::resource('posts', PostController::class);
Route::resource('users', UserController::class);

// Route::get("/Posts", [PostController::class, 'index']);
// Route::post("/Posts", [PostController::class, 'store']);
// Route::get("/Posts/{id}", [PostController::class, 'show']);
// Route::put("/Posts/{id}", [PostController::class, 'update']);
// Route::delete("/Posts/{id}", [PostController::class, 'destroy']);


Route::get("/Commentaires", [CommentairesController::class, 'index']);
Route::post("/Commentaires", [CommentairesController::class, 'store']);
Route::get("/Commentaires/{id}", [CommentairesController::class, 'show']);
Route::put("/Commentaires/{id}", [CommentairesController::class, 'update']);
Route::delete("/Commentaires/{id}", [CommentairesController::class, 'destroy']);


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


Route::get("/User", [UserController::class, 'index']);
Route::post("/User", [UserController::class, 'store']);
Route::get("/User/{id}", [UserController::class, 'show']);
Route::put("/User/{id}", [UserController::class, 'update']);
Route::delete("/User/{id}", [UserController::class, 'destroy']);
