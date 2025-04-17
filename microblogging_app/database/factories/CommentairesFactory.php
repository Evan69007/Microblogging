<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory; // Classe de base pour toutes les factories Laravel
use Carbon\Carbon; // Pour générer des dates actuelles

/**
 * Factory associée au modèle App\Models\Commentaires
 * Elle permet de générer automatiquement de faux commentaires pour les tests ou les seeders.
 */
class CommentairesFactory extends Factory
{
    /**
     * Définit l'état par défaut d'un commentaire généré.
     *
     * @return array<string, mixed> Données fictives à injecter dans la base
     */
    public function definition(): array
    {
        return [
            // Association à un utilisateur (id entre 1 et 4)
            'user_id' => $this->faker->numberBetween(1, 4),

            // Association à un post (id entre 1 et 10)
            'post_id' => $this->faker->numberBetween(1, 10),

            // Texte du commentaire, généré aléatoirement
            'description' => $this->faker->paragraph(),

            // Dates de création/modification
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
/* Une factory sert à générer automatiquement des données réalistes dans ta base pour :
    Tester ton code sans taper les données à la main
    Pré-remplir la base avec des valeurs d’exemple (via db:seed)
    Tester les relations entre modèles (user_id, post_id, etc.) */