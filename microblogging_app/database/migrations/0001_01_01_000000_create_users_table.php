<?php

use Illuminate\Database\Migrations\Migration;     // Classe de base pour toutes les migrations Laravel
use Illuminate\Database\Schema\Blueprint;         // Permet de définir la structure d’une table
use Illuminate\Support\Facades\Schema;            // Fournit les méthodes pour créer, modifier, supprimer les tables

// Migration anonyme retournée directement (pattern Laravel 8+)
return new class extends Migration
{
    /**
     * La méthode up() est appelée quand on exécute la migration avec `php artisan migrate`
     * Elle sert à créer les tables et définir leurs colonnes et relations
     */
    public function up(): void
    {
        // Création de la table "users"
        Schema::create('users', function (Blueprint $table) {
            $table->id()->onDelete('cascade');          // Clé primaire auto-incrémentée + suppression en cascade (⚠️ non supportée ici)
            $table->string('name');                     // Colonne nom
            $table->string('email')->unique();          // Email unique
            $table->timestamp('email_verified_at')->nullable(); // Date de vérification du mail (null par défaut)
            $table->string('password');                 // Mot de passe hashé
            $table->rememberToken();                    // Token pour "se souvenir de moi"
            $table->timestamps();                       // created_at et updated_at
        });

        // Table utilisée pour la réinitialisation des mots de passe
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();         // Email = clé primaire
            $table->string('token');                    // Token unique
            $table->timestamp('created_at')->nullable();// Date de création
        });

        // Table de sessions (utile si on utilise session driver "database")
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();             // ID de session (clé primaire)
            $table->foreignId('user_id')->nullable()->index(); // Lien avec un user
            $table->string('ip_address', 45)->nullable(); // IP de l’utilisateur
            $table->text('user_agent')->nullable();      // Navigateur utilisé
            $table->longText('payload');                 // Données de session sérialisées
            $table->integer('last_activity')->index();   // Timestamp de dernière activité
        });
    }

    /**
     * La méthode down() est appelée lorsqu’on fait un rollback (`php artisan migrate:rollback`)
     * Elle supprime les tables créées par up()
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};

/* Cette migration gère la structure des tables essentielles à l’authentification dans Laravel :

Table | Utilité principale
users | Stocke les infos des utilisateurs (nom, email, mot de passe, etc.)
password_reset_tokens | Permet de réinitialiser un mot de passe oublié
sessions | Suivi des connexions si on utilise les sessions côté serveur */