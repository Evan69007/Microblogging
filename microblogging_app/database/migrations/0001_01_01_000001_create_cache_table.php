<?php

use Illuminate\Database\Migrations\Migration;     // Classe de base pour toutes les migrations Laravel
use Illuminate\Database\Schema\Blueprint;         // Permet de définir les colonnes de la table
use Illuminate\Support\Facades\Schema;            // Fournit les fonctions pour manipuler la BDD

// Migration anonyme (standard Laravel 8+)
return new class extends Migration
{
    /**
     * La méthode `up()` est appelée lors de l'exécution de `php artisan migrate`.
     * Elle permet ici de créer deux tables utilisées pour le système de cache de Laravel.
     */
    public function up(): void
    {
        // ✅ Table "cache" : stocke les données mises en cache par Laravel
        Schema::create('cache', function (Blueprint $table) {
            $table->string('key')->primary();       // Clé unique pour identifier chaque élément du cache
            $table->mediumText('value');            // Contenu stocké en cache (sérialisé)
            $table->integer('expiration');          // Timestamp d’expiration du cache
        });

        // ✅ Table "cache_locks" : utilisée pour verrouiller une ressource pendant le caching
        Schema::create('cache_locks', function (Blueprint $table) {
            $table->string('key')->primary();       // Clé unique du verrou
            $table->string('owner');                // Identifiant de l’instance qui possède le verrou
            $table->integer('expiration');          // Timestamp à partir duquel le verrou expire
        });
    }

    /**
     * La méthode `down()` est appelée lors d’un rollback (`php artisan migrate:rollback`)
     * Elle supprime les deux tables.
     */
    public function down(): void
    {
        Schema::dropIfExists('cache');
        Schema::dropIfExists('cache_locks');
    }
};

/* Laravel utilise ces deux tables uniquement si tu configures un système de cache basé sur la base de données (DB driver dans config/cache.php).

Table	Utilité principale
cache	Stocke les paires clé/valeur pour le cache Laravel
cache_locks	Gère les verrous pour empêcher l’accès concurrent

📌 Quand sont-elles utilisées ?
    Lorsque tu utilises Cache::put(), Cache::remember() avec driver 'database'
    Lorsque Laravel a besoin de verrouiller une ressource partagée (ex. : file d’attente ou cache concurrent) */