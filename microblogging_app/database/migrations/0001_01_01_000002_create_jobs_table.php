<?php

use Illuminate\Database\Migrations\Migration;     // Classe de base pour les migrations Laravel
use Illuminate\Database\Schema\Blueprint;         // Permet de définir les colonnes de la table
use Illuminate\Support\Facades\Schema;            // Fournit les fonctions pour manipuler la base

// Migration anonyme (standard depuis Laravel 8)
return new class extends Migration
{
    /**
     * Méthode exécutée quand on lance `php artisan migrate`
     * Elle crée 3 tables liées au système de file d’attente Laravel : jobs, job_batches, failed_jobs
     */
    public function up(): void
    {
        // ✅ Table "jobs" : stocke les jobs en attente d’exécution
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();                                  // Clé primaire
            $table->string('queue')->index();              // Nom de la file (ex: "emails", "default")
            $table->longText('payload');                   // Contenu du job sérialisé (objet + données)
            $table->unsignedTinyInteger('attempts');       // Nombre de tentatives déjà effectuées
            $table->unsignedInteger('reserved_at')->nullable();  // Timestamp de réservation (job en cours)
            $table->unsignedInteger('available_at');       // Timestamp à partir duquel le job peut être exécuté
            $table->unsignedInteger('created_at');         // Timestamp de création du job
        });

        // ✅ Table "job_batches" : gère les lots de jobs (pour les batchs Laravel)
        Schema::create('job_batches', function (Blueprint $table) {
            $table->string('id')->primary();               // ID unique du lot (UUID)
            $table->string('name');                        // Nom du batch (utile pour le suivi)
            $table->integer('total_jobs');                 // Nombre total de jobs dans le batch
            $table->integer('pending_jobs');               // Nombre de jobs restants
            $table->integer('failed_jobs');                // Nombre de jobs échoués
            $table->longText('failed_job_ids');            // Liste des IDs de jobs échoués
            $table->mediumText('options')->nullable();     // Options supplémentaires du batch (JSON)
            $table->integer('cancelled_at')->nullable();   // Timestamp d’annulation (si annulé)
            $table->integer('created_at');                 // Timestamp de création
            $table->integer('finished_at')->nullable();    // Timestamp de fin d'exécution du batch
        });

        // ✅ Table "failed_jobs" : stocke les jobs échoués
        Schema::create('failed_jobs', function (Blueprint $table) {
            $table->id();                                  // Clé primaire
            $table->string('uuid')->unique();              // UUID unique pour suivre chaque job
            $table->text('connection');                    // Nom de la connexion utilisée (ex: "database", "redis")
            $table->text('queue');                         // File d’origine du job
            $table->longText('payload');                   // Contenu du job
            $table->longText('exception');                 // Message d’erreur / stacktrace
            $table->timestamp('failed_at')->useCurrent();  // Date de l’échec
        });
    }

    /**
     * Méthode rollback (appelée avec `php artisan migrate:rollback`)
     * Supprime les 3 tables créées
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
        Schema::dropIfExists('job_batches');
        Schema::dropIfExists('failed_jobs');
    }
};

/* Ce fichier crée les tables nécessaires au fonctionnement du système de file d’attente de Laravel, utile pour traiter des tâches en arrière-plan (asynchrone) :
Table	Rôle
jobs	Liste des jobs en attente ou en cours d’exécution
job_batches	Gère les lots de jobs lancés ensemble (batchs Laravel)
failed_jobs	Historique des jobs qui ont échoué (utile pour debug ou relancer)

🛠️ Quand tu utilises ça ?
    Envoi d’emails en arrière-plan
    Traitement d’images
    Enregistrement de logs lourds
    Notifications différées, synchronisation, etc. */