<?php

namespace App\Http\Controllers;

use App\Models\Commentaires; // Import du modèle Commentaires
use Illuminate\Http\Request; // Pour gérer les données HTTP reçues
use Carbon\Carbon; // Librairie pour gérer les dates

class CommentairesController extends Controller
{
    // ✅ Méthode pour afficher tous les commentaires
    public function index()
    {
        // Récupère tous les commentaires avec les données associées de l'utilisateur (relation 'user')
        $commentaire = Commentaires::with('user')->get();

        // Retourne les commentaires sous forme de réponse JSON
        return response()->json($commentaire);
    }

    // ✅ Méthode pour créer un nouveau commentaire
    public function store(Request $request)
    {
        // Création d'une nouvelle instance de commentaire
        $commentaire = new Commentaires();

        // Remplissage des champs avec les données envoyées par le front
        $commentaire->user_id = $request->user_id;
        $commentaire->post_id = $request->post_id;
        $commentaire->description = $request->description;

        // Définir manuellement la date de création (optionnel si les timestamps sont activés)
        $commentaire->created_at = Carbon::now()->toDateTimeString();

        // Sauvegarde du commentaire dans la base de données
        $commentaire->save();

        // Réponse de succès en JSON
        return response()->json(['message' => 'commentaire ajoute'], 200);
    }

    // ✅ Méthode pour afficher un commentaire spécifique par son ID
    public function show(string $id)
    {
        // Recherche le commentaire avec l'utilisateur associé
        $commentaire = Commentaires::with('user')->findOrFail($id);

        // Si trouvé, on le retourne en JSON
        if (!empty($commentaire)) {
            return response()->json($commentaire);
        } else {
            // Sinon, on retourne un message d'erreur
            return response()->json(['message' => 'commentaire introuvable'], 404);
        }
    }

    // ✅ Méthode pour mettre à jour un commentaire existant
    public function update(Request $request, string $id)
    {
        // Vérifie si un commentaire avec cet ID existe
        if (Commentaires::where('id', $id)->exists()) {
            // Récupère le commentaire
            $commentaire = Commentaires::find($id);

            // Met à jour les champs avec les nouvelles valeurs
            $commentaire->user_id = $request->user_id;
            $commentaire->post_id = $request->post_id;
            $commentaire->description = $request->description;

            // Met à jour la date de modification
            $commentaire->updated_at = Carbon::now()->toDateTimeString();

            // Sauvegarde les modifications
            $commentaire->save();

            // Réponse de succès
            return response()->json(['message' => 'commentaire modifie'], 200);
        } else {
            // Si le commentaire n'existe pas, retour d'une erreur
            return response()->json(['message' => 'commentaire introuvable'], 404);
        }
    }

    // ✅ Méthode pour supprimer un commentaire
    public function destroy(string $id)
    {
        // Vérifie si un commentaire avec cet ID existe
        if (Commentaires::where('id', $id)->exists()) {
            // Récupère et supprime le commentaire
            $commentaire = Commentaires::find($id);
            $commentaire->delete();

            // Réponse de succès
            return response()->json(['message' => 'commentaire supprimé']);
        } else {
            // Si le commentaire n'existe pas, retour d'une erreur
            return response()->json(['message' => 'commentaire introuvable'], 404);
        }
    }
}
/* Ce contrôleur permet de gérer toutes les actions liées aux commentaires postés par les utilisateurs sur les publications.
✅ Il permet de :
    Afficher tous les commentaires (index)
    Créer un nouveau commentaire (store)
    Voir un commentaire spécifique (show)
    Modifier un commentaire existant (update)
    Supprimer un commentaire (destroy)

⚙️ Il agit sur :
    La table commentaires
    Avec une relation vers les utilisateurs (user) et les posts (post_id) */