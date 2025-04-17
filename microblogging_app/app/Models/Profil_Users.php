<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // Pour activer les factories (seeders/tests)
use Illuminate\Database\Eloquent\Model;               // Modèle Eloquent de base
use Illuminate\Database\Eloquent\Relations\BelongsTo; // Pour déclarer la relation belongsTo

class Profil_Users extends Model
{
    /**
     * Utilisation du trait HasFactory
     * Permet de générer des données factices (ex : via une factory ou un seeder)
     */
    use HasFactory;

    /**
     * Champs qui peuvent être remplis automatiquement
     * Sécurité contre le mass assignment (on ne peut modifier que ces colonnes)
     */
    protected $fillable = [
        'user_id',
        'biographie',
    ];

    /**
     * On précise ici le nom de la table car il contient un underscore et ne suit pas la convention Laravel
     * Laravel chercherait par défaut une table "profil__users" (avec 2 underscores)
     */
    protected $table = 'profil_users';

    /**
     * Relation : un profil appartient à un utilisateur
     * Permet d’accéder à l’utilisateur via $profil->user
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}


/* Le modèle Profil_Users gère les informations complémentaires d’un utilisateur, séparées de la table users (comme une biographie ou d’autres champs optionnels).
✅ Il permet :
    D’ajouter une biographie à un utilisateur sans surcharger la table users
    De faire une relation 1:1 entre User et Profil_Users
    De modulariser les données : les infos sensibles (authentification) restent dans users, les infos publiques (bio, avatar, etc.) dans profil_users */