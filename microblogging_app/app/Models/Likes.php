<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo; // Pour définir les relations belongsTo
use Illuminate\Database\Eloquent\Factories\HasFactory; // Pour pouvoir générer des likes fictifs via une factory
use Illuminate\Database\Eloquent\Model; // Classe de base pour tous les modèles Eloquent

class Likes extends Model
{
    /**
     * Utilisation du trait HasFactory
     * Cela permet de générer facilement des données de test via une factory (ex: dans un seeder)
     */
    use HasFactory;

    /**
     * Liste des colonnes pouvant être remplies en masse (mass assignment)
     * Cela sécurise l'enregistrement des données côté back-end.
     */
    protected $fillable = [
        'user_id',
        'post_id',
    ];

    /**
     * Relation : un like appartient à un utilisateur
     * Permet de faire $like->user pour accéder à l’auteur du like
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relation : un like appartient à un post
     * Permet de faire $like->post pour accéder au post liké
     */
    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class, 'post_id');
    }
}

/* Le modèle Likes représente la table likes dans ta base de données.
C’est une table pivot personnalisée entre les utilisateurs et les posts, qui stocke les "likes" attribués à chaque post par un utilisateur.

✅ Il permet à Laravel de :
    Créer et gérer les likes dans la base

    Faire les relations entre :
        un utilisateur (user)
        un post (post)

    Faciliter les requêtes type :
		$post->likes;          // Tous les likes sur ce post
		$user->likes;          // Tous les posts likés par cet utilisateur
		$like->user->name;     // Nom de l’auteur du like
 */