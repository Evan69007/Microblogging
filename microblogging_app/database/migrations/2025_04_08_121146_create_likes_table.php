<?php

use Illuminate\Database\Migrations\Migration;     // Classe de base pour les migrations Laravel
use Illuminate\Database\Schema\Blueprint;         // Fournit les outils pour créer/modifier des tables
use Illuminate\Support\Facades\Schema;            // Fournit les fonctions pour manipuler les schémas de BDD

return new class extends Migration
{
    /**
     * La méthode `up()` s’exécute avec `php artisan migrate`.
     * Elle sert ici à créer la table `likes`.
     */
    public function up(): void
    {
        Schema::create('likes', function (Blueprint $table) {
            $table->id(); // Clé primaire auto-incrémentée : chaque "like" a un identifiant unique

            $table->timestamps(); // Colonnes "created_at" et "updated_at" générées automatiquement

            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            // Lien vers la table "users" : identifie qui a aimé
            // "cascade" = si un utilisateur est supprimé, ses likes aussi

            $table->foreignId('post_id')->constrained()->onDelete('cascade');
            // Lien vers la table "posts" : identifie quel post a été liké
            // "cascade" = si un post est supprimé, les likes liés aussi
        });
    }

    /**
     * La méthode `down()` est appelée lors d’un rollback (`php artisan migrate:rollback`).
     * Elle supprime ici la table `likes`.
     */
    public function down(): void
    {
        Schema::dropIfExists('likes');
    }
};

/* Cette table permet de suivre les interactions des utilisateurs avec les posts.
Chaque ligne représente un "j’aime" déposé par un utilisateur sur une publication.

✅ Ce que contient la table :
Colonne	Rôle
user_id	Identifie l’utilisateur qui a liké
post_id	Identifie le post qui a été liké
timestamps	Permet de savoir quand le like a été ajouté/modifié

🔄 Fonctionnalité rendue possible :
    Afficher le nombre de likes sur un post
    Vérifier si un utilisateur a déjà liké un post
    Supprimer automatiquement les likes quand un utilisateur ou un post est supprimé */