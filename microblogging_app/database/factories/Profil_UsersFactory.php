<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory; // Classe de base pour créer des factories
use Carbon\Carbon; // Pour générer les dates de création/mise à jour

/**
 * Factory liée au modèle App\Models\Profil_Users
 * Sert à générer des biographies liées à des utilisateurs
 */
class Profil_UsersFactory extends Factory
{
    /**
     * Définition de l’état par défaut d’un profil utilisateur
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // Associe le profil à un utilisateur unique (chaque user a 1 seul profil)
            'user_id' => $this->faker->unique()->numberBetween(1, 4),

            // Génère une biographie réaliste
            'biographie' => $this->faker->paragraph(),

            // Timestamps de création et modification
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}

/* Cette factory permet de générer automatiquement des profils d’utilisateurs, chacun lié à un user_id unique.
✅ Elle sert à :
    Pré-remplir ta base avec des biographies pour chaque utilisateur
    Tester l’affichage du profil public dans l’interface Vue.js
    Vérifier les relations User -> Profil_Users dans tes tests et seeders */