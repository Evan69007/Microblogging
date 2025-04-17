<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents; // Optionnel : évite d'exécuter les événements du modèle
use Illuminate\Database\Seeder;                            // Classe de base pour tous les seeders
use App\Models\Commentaires;                               // Modèle Commentaires

class CommentairesSeeder extends Seeder
{
    /**
     * Exécute le seeder : appelée via `php artisan db:seed`
     */
    public function run(): void
    {
        // Génère 10 commentaires fictifs grâce à la factory associée
        Commentaires::factory(10)->create();
    }
}

/* Ce seeder permet de remplir la table commentaires automatiquement avec des données de test (liées à des utilisateurs et des posts existants).
✅ Ce que ça permet :
    Tester l'affichage des commentaires sans les entrer manuellement
    Préparer des démos réalistes
    Tester les relations post -> commentaires et user -> commentaires */