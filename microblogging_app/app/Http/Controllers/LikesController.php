<?php

namespace App\Http\Controllers;

use App\Models\Likes; // Import du modèle Likes
use Illuminate\Http\Request; // Pour récupérer les données de la requête HTTP

class LikesController extends Controller
{
    // ✅ Méthode pour récupérer tous les likes avec les relations vers l'utilisateur et le post
    public function index()
    {
        // Charge tous les likes avec leurs relations 'user' et 'post'
        $Likes = Likes::with(['user', 'post'])->get();

        // Retourne la liste au format JSON
        return response()->json($Likes);
    }

    // ✅ Méthode pour ajouter un nouveau like
    public function store(Request $request)
    {
        // Création d'une nouvelle instance de Like
        $Likes = new Likes();

        // Association du like à un utilisateur et un post
        $Likes->user_id = $request->user_id;
        $Likes->post_id = $request->post_id;

        // Enregistrement dans la base de données
        $Likes->save();

        // Réponse de succès
        return response()->json(['message' => 'Like ajouté'], 200);
    }

    // ✅ Méthode pour afficher un like spécifique avec ses relations
    public function show(string $id)
    {
        // Recherche du like par son ID avec relations user et post
        $Likes = Likes::with(['user', 'post'])->findOrFail($id);

        // Vérifie qu'il existe (inutile avec findOrFail, mais laissé ici par sécurité)
        if (!empty($Likes)) {
            return response()->json($Likes);
        } else {
            return response()->json(['message' => 'Like introuvable'], 404);
        }
    }

    // ✅ Méthode pour modifier un like existant
    public function update(Request $request, string $id)
    {
        // Vérifie si le like existe
        if (Likes::where('id', $id)->exists()) {
            // Récupère l'objet like à modifier
            $Likes = Likes::find($id);

            // Met à jour les données
            $Likes->user_id = $request->user_id;
            $Likes->post_id = $request->post_id;

            // Sauvegarde les changements
            $Likes->save();

            return response()->json(['message' => 'Like modifié'], 200);
        } else {
            return response()->json(['message' => 'Like introuvable'], 404);
        }
    }

    // ✅ Méthode pour supprimer un like (basée sur l'ID du post)
    public function destroy(string $id)
    {
        // Vérifie si un like existe pour le post spécifié
        if (Likes::where('post_id', $id)->exists()) {
            // Récupère le premier like trouvé pour ce post
            $Likes = Likes::where('post_id', $id)->first();

            // Supprime le like
            $Likes->delete();

            return response()->json(['message' => 'Like supprimé']);
        } else {
            return response()->json(['message' => 'Like introuvable'], 404);
        }
    }
}

/* Ce contrôleur permet de gérer les likes qu’un utilisateur peut ajouter ou retirer sur un post.
✅ Il permet de :
    Afficher tous les likes enregistrés (index)
    Ajouter un like (store)
    Voir un like précis (show)
    Modifier un like (option peu utile en pratique) (update)
    Supprimer un like (destroy)

⚠️ À noter :

La suppression (destroy) utilise actuellement uniquement le post_id.
👉 Il serait plus précis d’utiliser un couple (user_id, post_id) si un post peut être liké par plusieurs utilisateurs.
⚙️ Il agit sur :
    La table likes
    Avec des relations vers user et post */