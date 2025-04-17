<?php

use Illuminate\Database\Migrations\Migration;     // Classe de base pour les migrations Laravel
use Illuminate\Database\Schema\Blueprint;         // Permet de définir les colonnes de la table
use Illuminate\Support\Facades\Schema;            // Fournit les fonctions pour créer/modifier/supprimer des tables

return new class extends Migration
{
    /**
     * La méthode `up()` est exécutée quand tu fais :
     * php artisan migrate
     * Elle crée ici la table `profil_users`.
     */
    public function up(): void
    {
        Schema::create('profil_users', function (Blueprint $table) {
            $table->id(); // Clé primaire auto-incrémentée

            $table->timestamps(); // Colonnes `created_at` et `updated_at`

            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade')
                ->unique();
            // Clé étrangère vers la table `users`
            // `constrained()` = équivalent à `references('id')->on('users')`
            // `onDelete('cascade')` = si l'utilisateur est supprimé, son profil aussi
            // `unique()` = un seul profil par utilisateur (relation 1:1)

            $table->text('biographie'); // Texte de biographie de l’utilisateur
        });
    }

    /**
     * La méthode `down()` est exécutée lors d’un rollback :
     * php artisan migrate:rollback
     * Elle supprime ici la table `profil_users`
     */
    public function down(): void
    {
        Schema::dropIfExists('profil_users');
    }
};

/* La table profil_users permet de stocker une biographie personnalisée pour chaque utilisateur de ton application PushMyCode.

Elle est liée en relation 1:1 avec la table users grâce à la clé étrangère unique user_id.
✅ Contenu de la table :
Colonne	Rôle
user_id	Référence l’utilisateur auquel appartient le profil
biographie	Texte libre rédigé par l’utilisateur
timestamps	Permet de savoir quand le profil a été créé/modifié */