<?php

use Illuminate\Database\Migrations\Migration;     // Classe de base pour les migrations Laravel
use Illuminate\Database\Schema\Blueprint;         // Permet de définir les colonnes et les types
use Illuminate\Support\Facades\Schema;            // Fournit les méthodes pour manipuler la base

return new class extends Migration
{
    /**
     * La méthode `up()` est appelée lors de l’exécution de la commande :
     * php artisan migrate
     * Elle crée ici la table "posts"
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id(); // Clé primaire auto-incrémentée (colonne "id")

            $table->string('titre'); // Titre du post (ex: "Créer une API avec Laravel")
            $table->text('description'); // Contenu ou corps du post

            $table->json('hashtags')->nullable(); 
            // Stocke les hashtags en JSON, permet de garder un tableau (ex: ["#laravel", "#vuejs"])

            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            // Clé étrangère vers la table "users"
            // `constrained()` = fait référence automatiquement à `users(id)`
            // `onDelete('cascade')` = supprime tous les posts de l’utilisateur s’il est supprimé

            $table->timestamps(); 
            // Colonnes "created_at" et "updated_at" générées automatiquement
        });
    }

    /**
     * La méthode `down()` est appelée lors d’un rollback :
     * php artisan migrate:rollback
     * Elle supprime la table "posts"
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
};

/* Cette migration crée la table posts, qui stocke les publications des utilisateurs dans ton application PushMyCode.

Elle est liée à la table users via la colonne user_id, ce qui permet de :
    retrouver facilement tous les posts d’un utilisateur
    supprimer automatiquement les posts si l’utilisateur est supprimé (cascade)

✅ Ce que cette table contient :
Champ	Type	Description
id	bigint	Identifiant unique du post
titre	string	Titre du post
description	text	Contenu détaillé
hashtags	json	Tableau de mots-clés (nullable)
user_id	foreignId	Référence vers l’utilisateur auteur
timestamps	dates	Dates de création et modification */