<?php

namespace App\Http\Controllers;

use App\Models\Profil_Users; // Import du modèle Profil_Users
use Carbon\Carbon; // Librairie pour gérer les dates facilement
use Illuminate\Http\Request; // Permet de gérer les requêtes HTTP entrantes

class ProfilUsersController extends Controller
{
    // ✅ Méthode pour récupérer tous les profils
    public function index()
    {
        // Récupère tous les profils avec leur utilisateur associé
        $profilusers = Profil_Users::with('user')->get();

        // Retourne les profils au format JSON
        return response()->json($profilusers);
    }

    // ✅ Méthode pour créer un nouveau profil utilisateur
    public function store(Request $request)
    {
        // Crée une nouvelle instance de Profil_Users
        $Profil_Users = new Profil_Users();

        // Rattache l'utilisateur via son ID
        $Profil_Users->user_id = $request->user_id;

        // Si une biographie est fournie, on l'enregistre. Sinon, on enregistre une chaîne vide.
        if (!empty($request->biographie)) {
            $Profil_Users->biographie = $request->biographie;
        } else {
            $Profil_Users->biographie = "";
        }

        // Enregistre la date de création
        $Profil_Users->created_at = Carbon::now()->toDateTimeString();

        // Sauvegarde du profil en base
        $Profil_Users->save();

        // Réponse JSON de succès
        return response()->json(['message' => 'Profil_Users ajouté'], 200);
    }

    // ✅ Méthode pour afficher un profil utilisateur spécifique (par ID utilisateur)
    public function show(string $id)
    {
        // Récupère le profil lié à un utilisateur spécifique
        $Profil_Users = Profil_Users::with('user')->where('user_id', $id)->first();

        // Si trouvé, on retourne le profil en JSON
        if (!empty($Profil_Users)) {
            return response()->json($Profil_Users);
        } else {
            // Sinon, message d'erreur
            return response()->json(['message' => 'Profil_Users introuvable'], 404);
        }
    }

    // ✅ Méthode pour modifier un profil utilisateur existant
    public function update(Request $request, string $id)
    {
        // Vérifie si un profil existe avec cet ID
        if (Profil_Users::where('id', $id)->exists()) {
            // Récupère le profil
            $Profil_Users = Profil_Users::find($id);

            // Met à jour les champs
            $Profil_Users->user_id = $request->user_id;
            $Profil_Users->biographie = $request->biographie;

            // Met à jour la date de modification
            $Profil_Users->updated_at = Carbon::now()->toDateTimeString();

            // Sauvegarde les modifications
            $Profil_Users->save();

            return response()->json(['message' => 'Profil_Users modifié'], 200);
        } else {
            return response()->json(['message' => 'Profil_Users introuvable'], 404);
        }
    }

    // ✅ Méthode pour supprimer un profil utilisateur
    public function destroy(string $id)
    {
        // Vérifie si un profil existe avec cet ID
        if (Profil_Users::where('id', $id)->exists()) {
            // Supprime le profil
            $Profil_Users = Profil_Users::find($id);
            $Profil_Users->delete();

            return response()->json(['message' => 'Profil_Users supprimé']);
        } else {
            return response()->json(['message' => 'Profil_Users introuvable'], 404);
        }
    }
}

/* Ce contrôleur gère l'accès et la gestion des profils utilisateurs, séparément des données de connexion (email, mot de passe).
✅ Il permet :
    D’associer une biographie à un utilisateur
    De récupérer ou modifier ces données de profil
    De séparer clairement la logique de présentation utilisateur de la logique d’authentification

⚙️ Utilisé typiquement pour :
    Afficher une page "Mon profil" ou "Profil d’un autre utilisateur"
    Permettre à chacun de personnaliser son espace avec une description */