<?php

namespace App\Http\Controllers;

use App\Models\Post; // On importe le modèle Post
use Illuminate\Http\Request; // Pour gérer les requêtes HTTP (données envoyées par le client)

class PostController extends Controller
{
    // ✅ Récupérer tous les posts
    public function index()
    {
        // Récupère tous les posts avec l'utilisateur associé (relation 'user')
        $posts = Post::with('user')->get();

        // Renvoie les posts au format JSON
        return response()->json($posts);
    }

    // ✅ Créer un nouveau post
    public function store(Request $request)
    {
        // Crée un nouveau post avec les données envoyées
        $post = Post::create([
            'titre' => $request->titre,
            'description' => $request->description,
            'user_id' => $request->user_id,
            'hashtags' => $request->hashtags, // Assure-toi que c'est un champ accepté dans le modèle
        ]);

        // Retourne le post avec l'utilisateur associé
        return response()->json($post->load('user'));
    }

    // ✅ Afficher un post spécifique
    public function show($id)
    {
        // Cherche le post avec son utilisateur
        $post = Post::with('user')->findOrFail($id);

        // Vérifie qu'il existe (inutile avec findOrFail, mais laissé ici)
        if (!empty($post)) {
            return response()->json($post);
        } else {
            return response()->json(['message' => 'post introuvable'], 404);
        }
    }

    // ✅ Mettre à jour un post existant
    public function update(Request $request, $id)
    {
        // Cherche le post à modifier
        $post = Post::findOrFail($id);

        // Met à jour les champs modifiables
        $post->update([
            'titre' => $request->titre,
            'description' => $request->description,
            'hashtags' => $request->hashtags,
        ]);

        // Renvoie le post mis à jour avec son utilisateur
        return response()->json($post->load('user'));
    }

    // ✅ Supprimer un post
    public function destroy($id)
    {
        // Cherche le post
        $post = Post::findOrFail($id);

        // Supprime le post
        $post->delete();

        // Réponse JSON de confirmation
        return response()->json(['message' => 'Post supprimé']);
    }
}

/* Un contrôleur est une classe qui gère les requêtes HTTP entrantes (depuis le front-end ou un client API), et retourne une réponse (souvent en JSON ou en vue HTML).
✅ Il fait le lien entre :
    Le modèle (base de données, logique métier)
    Le client (navigateur, app front, outil comme Postman)

⚙️ Le PostController :
    Reçoit les requêtes pour créer, lire, modifier, ou supprimer des posts
    Utilise le modèle Post pour interagir avec la base de données
    Retourne une réponse en JSON, utilisée dans ton app Vue.js */