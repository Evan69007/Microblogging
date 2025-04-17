<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // Pour permettre la génération de données avec une factory
use Illuminate\Database\Eloquent\Model; // Modèle Eloquent de base
use Illuminate\Database\Eloquent\Relations\BelongsTo; // Relation : appartient à un utilisateur
use Illuminate\Database\Eloquent\Relations\HasMany;   // Relation : a plusieurs likes/commentaires

class Post extends Model
{
    /**
     * Utilise le trait HasFactory pour les tests ou les seeders
     */
    use HasFactory;

    /**
     * Liste des colonnes pouvant être remplies en masse (mass assignment)
     */
    protected $fillable = [
        'user_id',
        'titre',
        'description',
        'hashtags',
    ];

    /**
     * Définition du "casting" automatique de certains champs
     * Ici, 'hashtags' sera automatiquement converti en tableau (array)
     * lors de la lecture/écriture avec Eloquent
     */
    protected function casts(): array
    {
        return [
            'hashtags' => 'array',
        ];
    }

    /**
     * Relation : un post appartient à un utilisateur
     * Permet d’accéder à l’auteur du post avec $post->user
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relation : un post peut avoir plusieurs likes
     * Permet d’accéder aux likes avec $post->likes
     */
    public function likes(): HasMany
    {
        return $this->hasMany(Likes::class, 'post_id');
    }

    /**
     * Relation : un post peut avoir plusieurs commentaires
     * Permet d’accéder aux commentaires avec $post->commentaires
     */
    public function commentaires(): HasMany
    {
        return $this->hasMany(Commentaires::class, 'post_id');
    }
}


/* Le modèle Post représente les publications des utilisateurs dans ton application PushMyCode.
✅ Il permet :

    De créer, lire, modifier et supprimer des posts

    De récupérer :
        l’auteur du post (user)
        les likes associés (likes)
        les commentaires liés (commentaires)

    De stocker une liste de hashtags sous forme de tableau (array casté automatiquement)
    
    🔁 Exemples d’utilisation :
    $post->user->name;               // Affiche le nom de l’auteur du post
$post->likes()->count();         // Nombre de likes sur le post
$post->commentaires;             // Tous les commentaires liés
$post->hashtags;                 // Array de hashtags
*/