<?php

use Illuminate\Database\Migrations\Migration;     // Classe de base pour les migrations Laravel
use Illuminate\Database\Schema\Blueprint;         // Permet de définir la structure des tables
use Illuminate\Support\Facades\Schema;            // Fournit les méthodes pour manipuler la base de données

return new class extends Migration
{
    /**
     * La méthode `up()` s’exécute lors de la commande :
     * php artisan migrate
     * Elle crée ici la table "commentaires"
     */
    public function up(): void
    {
        Schema::create('commentaires', function (Blueprint $table) {
            $table->id(); // Clé primaire auto-incrémentée (colonne "id")

            $table->timestamps(); // Colonnes "created_at" et "updated_at"

            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            // Lien vers l'utilisateur qui a écrit le commentaire
            // `constrained()` = référence la table `users`
            // `onDelete('cascade')` = si l'utilisateur est supprimé, ses commentaires le sont aussi

            $table->foreignId('post_id')->constrained()->onDelete('cascade');
            // Lien vers le post commenté
            // Si le post est supprimé, tous les commentaires associés sont aussi supprimés

            $table->text('description');
            // Contenu du commentaire (texte libre)
        });
    }

    /**
     * La méthode `down()` est appelée lors d’un rollback :
     * php artisan migrate:rollback
     * Elle supprime la table "commentaires"
     */
    public function down(): void
    {
        Schema::dropIfExists('commentaires');
    }
};


/* Elle permet de créer la table commentaires, qui stocke tous les commentaires des utilisateurs sur les publications (posts).
📌 Ce que cette table permet :
Colonne	Rôle
user_id	Identifie l’auteur du commentaire
post_id	Indique à quel post appartient ce commentaire
description	Contient le contenu écrit par l’utilisateur
timestamps	Enregistre quand le commentaire a été créé ou modifié */