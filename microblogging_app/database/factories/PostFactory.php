<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory; // Classe de base des factories Laravel
use Illuminate\Support\Str;                         // Non utilisé ici mais souvent utile pour les slugs ou tokens
use Carbon\Carbon;                                  // Pour gérer les dates

/**
 * Factory liée au modèle App\Models\Post
 * Elle permet de générer automatiquement des posts de test ou de démo
 */
class PostFactory extends Factory
{
    /**
     * Définit les données par défaut pour un post généré
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // Date de création (et potentiellement update) du post
            'created_at' => Carbon::now(),

            // Associe le post à un utilisateur fictif (id entre 1 et 4)
            'user_id' => $this->faker->numberBetween(1, 4),

            // Génère un titre court
            'titre' => $this->faker->sentence(),

            // Génère une description réaliste
            'description' => $this->faker->paragraph(),

            // Génère entre 1 et 4 hashtags aléatoires depuis une liste
            'hashtags' => $this->faker->randomElements(
                ['#tech', '#code', '#laravel', '#php', '#opensource', '#ada', '#devlife'],
                rand(1, 4) // Choisit entre 1 et 4 éléments
            ),
        ];
    }
}

/* Cette factory permet de générer automatiquement des publications (posts) dans ta base, en lien avec un utilisateur existant.
✅ Elle est utile pour :
    Tester ton système d’affichage de posts sans taper les données à la main
    Pré-remplir la base en phase de démo ou développement
    Simuler l’activité d’utilisateurs avec de vrais titres, descriptions, hashtags */