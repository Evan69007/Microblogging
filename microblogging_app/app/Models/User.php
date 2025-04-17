<?php

namespace App\Models;

// Imports des traits et relations nécessaires
use Illuminate\Database\Eloquent\Factories\HasFactory;           // Pour générer des utilisateurs fictifs via des factories
use Illuminate\Foundation\Auth\User as Authenticatable;           // Modèle de base pour les utilisateurs authentifiables (login, token, etc.)
use Illuminate\Notifications\Notifiable;                          // Permet d’envoyer des notifications à l’utilisateur
use Illuminate\Database\Eloquent\Relations\HasMany;              // Pour les relations "1-n"
use Laravel\Sanctum\HasApiTokens;                                // Pour gérer l’authentification via API token (Sanctum)

class User extends Authenticatable
{
    /**
     * Traits activés : API Tokens, Factories, Notifications
     */
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Champs que l’on peut remplir automatiquement (mass assignment)
     * Sécurité : seuls ces champs peuvent être remplis lors d’un `create()` ou `update()`
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * Champs à cacher lorsqu’on renvoie un utilisateur en JSON (par exemple pour un front)
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Casting automatique de certains champs vers des types natifs PHP
     * Exemple : 'password' sera haché automatiquement, 'email_verified_at' sera une instance Carbon
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Relation : un utilisateur peut avoir plusieurs likes
     */
    public function likes(): HasMany
    {
        return $this->hasMany(Likes::class, 'user_id');
    }

    /**
     * Relation : un utilisateur peut avoir plusieurs commentaires
     */
    public function commentaires(): HasMany
    {
        return $this->hasMany(Commentaires::class, 'user_id');
    }

    /**
     * Relation : un utilisateur peut avoir plusieurs entrées dans Profil_Users
     * ⚠️ À noter : normalement c’est une relation 1:1, donc `hasOne` serait plus logique ici.
     */
    public function profil_users(): HasMany
    {
        return $this->hasMany(Profil_Users::class, 'user_id');
    }

    /**
     * Relation : un utilisateur peut écrire plusieurs posts
     */
    public function post(): HasMany
    {
        return $this->hasMany(Post::class, 'user_id');
    }
}

/* Le modèle User est central dans ton application.
Il représente chaque membre de PushMyCode et gère :
✅ Ses rôles :
    L’authentification (connexion, token via Sanctum)
    La gestion des données personnelles (nom, mail, mot de passe)
    Les relations avec les autres entités :
        posts (publications créées)
        likes (posts aimés)
        commentaires (commentaires laissés)
        profil_users (biographie et infos visibles)

 */