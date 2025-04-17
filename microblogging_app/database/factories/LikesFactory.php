<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory; // Classe de base pour générer des données de test
use Carbon\Carbon; // Utilisé ici pour générer des dates actuelles

/**
 * Factory pour le modèle App\Models\Likes
 * Sert à générer automatiquement des likes fictifs entre utilisateurs et posts
 */
class LikesFactory extends Factory
{
    /**
     * Définition de l'état par défaut d'un Like généré.
     * 
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // Associe le like à un utilisateur entre l'id 1 et 4
            'user_id' => $this->faker->numberBetween(1, 4),

            // Associe le like à un post entre l'id 1 et 10
            'post_id' => $this->faker->numberBetween(1, 10),

            // Timestamps personnalisés avec Carbon
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}

/* Cette factory permet de générer rapidement des données réalistes pour la table likes, qui fait le lien entre :
    des utilisateurs (user_id)
    des posts (post_id)

Elle est très utile pour :
    tester le système de likes sans les créer manuellement
    pré-remplir ta base dans un seeder pour tes démonstrations ou ton environnement local */