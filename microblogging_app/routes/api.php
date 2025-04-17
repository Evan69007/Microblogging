<?php

// ✅ Import des contrôleurs utilisés
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfilUsersController;
use App\Http\Controllers\CommentairesController;
use App\Http\Controllers\LikesController;

// ✅ Import des classes utiles de Laravel
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

// ✅ Import des modèles utilisés
use App\Models\User;
use App\Models\Profil_Users;
use Carbon\Carbon;

// ================================
// 🔐 Authentification : REGISTER
// ================================
Route::post('/register', function (Request $request) {
    try {
        // Validation des données envoyées
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        // Création du nouvel utilisateur
        $newUser = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);
    } catch (\Exception $e) {
        // Gestion d’erreur (ex : email déjà utilisé)
        return response()->json(['error' => $e->getMessage()], 500);
    }

    // Génération du token pour Sanctum
    $token = $newUser->createToken('auth_token')->plainTextToken;

    return response()->json([
        'user' => $newUser,
        'access_token' => $token,
        'token_type' => 'Bearer',
    ], 201);
});

// ================================
// 🔐 Authentification : LOGIN
// ================================
Route::post('/login', function (Request $request) {
    if (!$request->has(['email', 'password'])) {
        return response()->json(['message' => 'Email and password are required'], 400);
    }

    $credentials = $request->only('email', 'password');

    if (!Auth::attempt($credentials)) {
        return response()->json(['message' => 'Unauthorized'], 401);
    }

    $user = Auth::user();
    $token = $user->createToken('auth_token')->plainTextToken;

    return response()->json([
        'access_token' => $token,
        'token_type' => 'Bearer',
    ]);
});

// ==========================================
// 👤 Mise à jour du profil utilisateur connecté
// ==========================================
Route::middleware('auth:sanctum')->put('/user/update', function (Request $request) {
    $user = $request->user();

    if (!$request->hasAny(['name', 'email', 'biographie', 'password'])) {
        return response()->json(['message' => 'No data to update'], 400);
    }

    try {
        $validatedData = $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|string|email|max:255|unique:users,email,' . $user->id,
            'biographie' => 'sometimes|string|max:1000',
            'password' => 'sometimes|string|min:6'
        ]);
    } catch (\Illuminate\Validation\ValidationException $e) {
        return response()->json(['message' => 'Validation failed', 'errors' => $e->errors()], 422);
    }

    if (isset($validatedData['name'])) $user->name = $validatedData['name'];
    if (isset($validatedData['email'])) $user->email = $validatedData['email'];
    if (isset($validatedData['password'])) $user->password = Hash::make($validatedData['password']);

    // Biographie : mise à jour ou création si inexistante
    if (isset($validatedData['biographie'])) {
        $Profil_Users = Profil_Users::firstOrNew(['user_id' => $user->id]);
        $Profil_Users->biographie = $validatedData['biographie'];
        $Profil_Users->updated_at = Carbon::now();
        if (!$Profil_Users->exists) $Profil_Users->created_at = Carbon::now();
        $Profil_Users->save();
    }

    $user->save();

    return response()->json(['message' => 'User updated successfully', 'user' => $user]);
});

// ================================
// 🚪 Déconnexion (suppression des tokens)
// ================================
Route::middleware('auth:sanctum')->post('/logout', function (Request $request) {
    $request->user()->tokens()->delete();
    return response()->json(['message' => 'User disconnected'], 200);
});

// ================================
// 👁️ Récupérer l'utilisateur connecté
// ================================
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return response()->json($request->user());
});

// ================================
// 📦 Routes REST automatiques
// ================================
Route::resource('posts', PostController::class);  // CRUD pour les posts
Route::resource('users', UserController::class);  // CRUD pour les utilisateurs

// ================================
// 💬 Routes manuelles pour les commentaires
// ================================
Route::get("/Commentaires", [CommentairesController::class, 'index']);
Route::post("/Commentaires", [CommentairesController::class, 'store']);
Route::get("/Commentaires/{id}", [CommentairesController::class, 'show']);
Route::put("/Commentaires/{id}", [CommentairesController::class, 'update']);
Route::delete("/Commentaires/{id}", [CommentairesController::class, 'destroy']);

// ================================
// 🧾 Routes pour les profils utilisateurs
// ================================
Route::get("/Profil_Users", [ProfilUsersController::class, 'index']);
Route::post("/Profil_Users", [ProfilUsersController::class, 'store']);
Route::get("/Profil_Users/{id}", [ProfilUsersController::class, 'show']);
Route::put("/Profil_Users/{id}", [ProfilUsersController::class, 'update']);
Route::delete("/Profil_Users/{id}", [ProfilUsersController::class, 'destroy']);

// ================================
// ❤️ Routes pour les likes
// ================================
Route::get("/likes", [LikesController::class, 'index']);
Route::post("/likes", [LikesController::class, 'store']);
Route::get("/likes/{id}", [LikesController::class, 'show']);
Route::put("/likes/{id}", [LikesController::class, 'update']);
Route::delete("/likes/{id}", [LikesController::class, 'destroy']);

// ================================
// 🔁 Autres accès utilisateurs manuels
// ================================
Route::get("/User", [UserController::class, 'index']);
Route::post("/User", [UserController::class, 'store']);
Route::get("/User/{id}", [UserController::class, 'show']);
Route::put("/User/{id}", [UserController::class, 'update']);
Route::delete("/User/{id}", [UserController::class, 'destroy']);

/* Ce fichier définit toutes les routes d’API de ton application Laravel, c’est-à-dire les points d’entrée que le front-end (Vue.js dans ton cas) va appeler pour interagir avec le back-end.

Il joue un rôle essentiel dans la communication entre l'interface utilisateur et la base de données.
✅ Ce qu’il contient :

🔐 Routes d’authentification
    /register → Créer un nouvel utilisateur
    /login → Connexion utilisateur + génération d’un token
    /logout → Déconnexion (suppression du token)
    /user/update → Mise à jour du profil utilisateur (avec biographie)
    /user → Récupération de l'utilisateur connecté (profil)

📦 Routes RESTful (CRUD)
    Route::resource('posts', PostController::class) → Toutes les opérations sur les publications
    Route::resource('users', UserController::class) → Toutes les opérations sur les utilisateurs

💬 Commentaires
    Créer, lire, modifier, supprimer des commentaires liés aux posts

🧾 Profils utilisateurs
    Gérer la biographie associée à chaque utilisateur

❤️ Likes
    Ajouter ou retirer un like sur un post
    Compter les likes par utilisateur ou post

📌 Pourquoi c’est important dans ton projet :
    Il sert de pont entre ton front Vue.js et ta base PostgreSQL via Laravel
    Il définit qui peut faire quoi, avec ou sans authentification (auth:sanctum)
    Il te permet de modulariser les fonctions de ton app : posts, likes, commentaires, profil_users, etc.
    Il garantit que les données sont validées, sécurisées et bien orientées vers les bons contrôleurs */