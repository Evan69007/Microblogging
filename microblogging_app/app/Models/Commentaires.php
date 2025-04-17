<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo; // Pour les relations belongsTo
use Illuminate\Database\Eloquent\Factories\HasFactory; // Pour permettre l’utilisation de factories
use Illuminate\Database\Eloquent\Model; // Modèle de base Eloquent

class Commentaires extends Model
{
    /**
     * Utilise le trait HasFactory pour permettre la génération de données factices
     * (utile pour les tests ou les seeders)
     */
    use HasFactory;

    /**
     * Liste des champs que l’on peut remplir automatiquement (mass assignment)
     * Cela protège contre les tentatives de modification non autorisées.
     */
    protected $fillable = [
        'user_id',
        'post_id',
        'description',
    ];

    /**
     * Relation : un commentaire appartient à un utilisateur
     * Cela permet d’accéder aux infos de l’auteur via $commentaire->user
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relation : un commentaire appartient à un post
     * Cela permet d’accéder au post associé via $commentaire->post
     */
    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class, 'post_id');
    }
}

/* Le modèle Commentaires représente la table commentaires dans ta base de données.

Il permet à Laravel de :
    Créer, lire, modifier et supprimer des commentaires
    Accéder facilement aux utilisateurs liés à chaque commentaire (user) et aux posts concernés (post)
    Utiliser des factories pour générer des commentaires fictifs dans les seeders
    Protéger les données grâce à $fillable (évite l'injection de champs inattendus) */