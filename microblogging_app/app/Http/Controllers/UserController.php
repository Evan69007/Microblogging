<?php

namespace App\Http\Controllers;

use App\Models\User; // On importe le modèle User
use Illuminate\Http\Request; // Pour gérer les requêtes HTTP
use Illuminate\Support\Facades\Hash; // Pour hacher les mots de passe
use Carbon\Carbon; // Pour gérer les dates

class UserController extends Controller
{
    // ✅ Méthode pour récupérer tous les utilisateurs
    public function index()
    {
        // Récupère tous les utilisateurs avec leurs relations :
        // - likes (les posts qu’ils ont aimés)
        // - post (les posts qu’ils ont publiés)
        // - profil_Users (leur biographie)
        $users = User::with(['likes', 'post', 'profil_Users'])->get();

        // Retourne les utilisateurs au format JSON
        return response()->json($users);
    }

    // ✅ Méthode pour créer un nouvel utilisateur
    public function store(Request $request)
    {
        $user = new User();

        // Remplit les champs du nouvel utilisateur
        $user->name = $request->name;
        $user->email = $request->email;

        // Le mot de passe est haché pour la sécurité
        $user->password = Hash::make($request->password);

        // Date de création manuelle (optionnelle si timestamps activés)
        $user->created_at = Carbon::now()->toDateTimeString();

        // Enregistre l'utilisateur en base
        $user->save();

        // Retourne une réponse de confirmation
        return response()->json(['message' => 'User ajouté'], 200);
    }

    // ✅ Méthode pour afficher un utilisateur par son ID
    public function show(string $id)
    {
        // Cherche l'utilisateur avec ses relations
        $user = User::with(['likes', 'post', 'profil_Users'])->findOrFail($id);

        // Vérifie qu’il existe (le if est facultatif ici car findOrFail lance une exception si non trouvé)
        if (!empty($user)) {
            return response()->json($user);
        } else {
            return response()->json(['message' => 'User introuvable'], 404);
        }
    }

    // ✅ Méthode pour mettre à jour un utilisateur
    public function update(Request $request, string $id)
    {
        // Vérifie si l'utilisateur existe
        if (User::where('id', $id)->exists()) {
            $user = User::find($id);

            // Met à jour les champs modifiables
            $user->name = $request->name;
            $user->email = $request->email;

            // Nouveau mot de passe haché
            $user->password = Hash::make($request->password);

            // Met à jour la date de modification
            $user->updated_at = Carbon::now()->toDateTimeString();

            // Sauvegarde les modifications
            $user->save();

            return response()->json(['message' => 'User modifié'], 200);
        } else {
            return response()->json(['message' => 'User introuvable'], 404);
        }
    }

    // ✅ Méthode pour supprimer un utilisateur
    public function destroy(string $id)
    {
        // Vérifie si l'utilisateur existe
        if (User::where('id', $id)->exists()) {
            $user = User::find($id);

            // Supprime l'utilisateur de la base
            $user->delete();

            return response()->json(['message' => 'User supprimé']);
        } else {
            return response()->json(['message' => 'User introuvable'], 404);
        }
    }
}
/* Le contrôleur UserController gère toutes les actions CRUD liées à un utilisateur dans ton application.
✅ Il permet :
    De lister tous les utilisateurs (avec leurs posts, likes, biographie)
    D’ajouter un nouvel utilisateur avec mot de passe sécurisé
    D’afficher un profil utilisateur complet (via son ID)
    De modifier un utilisateur existant
    De supprimer un utilisateur

⚙️ C’est un élément central de ton back-end, car :
    Il regroupe toutes les données personnelles de l’utilisateur
    Il se connecte aux autres entités du projet : posts, likes, biographie
    Il est utilisé à la fois pour l'authentification et l'affichage du profil */