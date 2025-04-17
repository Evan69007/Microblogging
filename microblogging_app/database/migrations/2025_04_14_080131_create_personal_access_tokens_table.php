<?php

use Illuminate\Database\Migrations\Migration;     // Classe de base des migrations Laravel
use Illuminate\Database\Schema\Blueprint;         // Fournit les outils pour construire la table
use Illuminate\Support\Facades\Schema;            // Fournit les méthodes pour manipuler le schéma de la BDD

return new class extends Migration
{
    /**
     * Méthode exécutée quand on lance :
     * php artisan migrate
     * Elle crée la table des tokens utilisés par Laravel Sanctum.
     */
    public function up(): void
    {
        Schema::create('personal_access_tokens', function (Blueprint $table) {
            $table->id(); // Clé primaire auto-incrémentée

            $table->morphs('tokenable');
            // Crée deux colonnes : tokenable_id (entier) et tokenable_type (string)
            // Utilisé pour gérer une relation polymorphe (ex : plusieurs modèles peuvent avoir des tokens)

            $table->string('name'); // Nom du token (ex : "token pour API mobile")

            $table->string('token', 64)->unique();
            // Le token généré par Sanctum (stocké hashé)

            $table->text('abilities')->nullable();
            // Liste des permissions accordées à ce token (sous forme JSON ou texte)

            $table->timestamp('last_used_at')->nullable(); // Date de dernière utilisation du token

            $table->timestamp('expires_at')->nullable(); // Date d’expiration éventuelle

            $table->timestamps(); // created_at & updated_at
        });
    }

    /**
     * Méthode exécutée lors d’un rollback :
     * php artisan migrate:rollback
     * Elle supprime la table `personal_access_tokens`.
     */
    public function down(): void
    {
        Schema::dropIfExists('personal_access_tokens');
    }
};

/* Cette table est utilisée par Laravel Sanctum pour gérer l'authentification API via tokens personnels.

Elle stocke :
    les tokens d’accès associés à des utilisateurs (ou autres modèles)
    leurs permissions, date de création, date de dernière utilisation, etc.

✅ Ce que ça permet dans ton app :
Colonne	Utilité
tokenable_id/type	Gère la relation polymorphe avec l'utilisateur (ou autre modèle)
token	Identifie de manière sécurisée l’accès API
abilities	Liste les actions permises par ce token
expires_at	Permet d’expirer automatiquement un token
 */