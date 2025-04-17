<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;     // Classe de base pour toutes les factories Laravel
use Illuminate\Support\Facades\Hash;                    // Pour hasher le mot de passe
use Illuminate\Support\Str;                             // Pour générer un token aléatoire

/**
 * Factory associée au modèle App\Models\User
 * Elle permet de générer des utilisateurs fictifs avec email, mot de passe, etc.
 */
class UserFactory extends Factory
{
    /**
     * Variable statique pour conserver le mot de passe hashé
     * Cela évite de hasher plusieurs fois la même chaîne en mémoire
     */
    protected static ?string $password;

    /**
     * Définition de l'état par défaut d’un utilisateur
     * 
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // Nom complet de l’utilisateur (fictif)
            'name' => fake()->name(),

            // Email unique et sécurisé
            'email' => fake()->unique()->safeEmail(),

            // Date de vérification d'email (fixée à maintenant)
            'email_verified_at' => now(),

            // Mot de passe hashé (par défaut "password")
            'password' => static::$password ??= Hash::make('password'),

            // Token pour "se souvenir" de l'utilisateur (ex: cookie remember me)
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Permet de définir un état "non vérifié" (email non confirmé)
     * Peut être utile pour les tests de vérification d’email
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}

/* Cette factory sert à générer rapidement des utilisateurs fictifs pour :
    tester les fonctionnalités de ton app (login, profil, posts, etc.),
    remplir automatiquement ta base pour des démos ou des tests automatiques (php artisan db:seed). */