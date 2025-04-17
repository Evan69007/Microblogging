<?php

namespace Database\Seeders;

use App\Models\User;                 // Modèle User pour insérer les utilisateurs
use Illuminate\Database\Seeder;      // Classe de base pour tous les seeders
use Illuminate\Support\Facades\DB;   // (Non utilisé ici, peut être supprimé)
use Illuminate\Support\Facades\Hash; // Pour hasher les mots de passe
use Carbon\Carbon;                   // (Non utilisé ici, peut être supprimé)

class UserSeeder extends Seeder
{
    /**
     * Méthode exécutée lors de :
     * php artisan db:seed --class=UserSeeder
     */
    public function run(): void
    {
        // 📥 Récupération des données JSON contenant les utilisateurs
        $jsonData = file_get_contents(database_path('data/users.json'));

        // 🔁 Décodage du JSON en tableau associatif PHP
        $users = json_decode($jsonData, true);

        // 🔁 Pour chaque utilisateur contenu dans le JSON
        foreach ($users as $userData) {
            // 🧑 Création de l'utilisateur dans la base de données
            $user = User::create([
                'name' => $userData['name'],
                'email' => $userData['email'],
                'password' => Hash::make($userData['password']) // Mot de passe sécurisé
            ]);

            // 🔐 Création d'un token Sanctum pour cet utilisateur
            $token = $user->createToken('AuthToken')->plainTextToken;

            // 🖨️ Affichage du token dans la console pour info/démo
            $this->command->info("Utilisateur {$user->email} créé avec le token : {$token}");
        }
    }
}

/* Ce seeder permet de créer les utilisateurs de ton app à partir d’un fichier users.json, en :
    sécurisant les mots de passe (hash)
    générant un token d’authentification Sanctum pour chaque utilisateur
    facilitant les tests en affichant les tokens dans le terminal

    Le UserSeeder doit être exécuté avant :
    ProfilUsersSeeder (pour relier les bios à l'utilisateur)
    PostSeeder (pour créer les posts de chaque user)*/