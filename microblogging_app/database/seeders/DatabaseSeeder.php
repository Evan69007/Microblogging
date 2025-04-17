<?php

namespace Database\Seeders;

use App\Models\Profil_Users;
use App\Models\User;
use App\Models\Post;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents; // Optionnel : permet d'ignorer les événements liés au modèle
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Point d’entrée principal de tous les seeders.
     * Exécuté via : php artisan db:seed
     */
    public function run(): void
    {
        // On appelle ici tous les seeders dans un ordre logique :
        $this->call([
            UserSeeder::class,             // 1️⃣ Crée les utilisateurs
            PostSeeder::class,             // 2️⃣ Crée les posts (liés aux users)
            CommentairesSeeder::class,     // 3️⃣ Crée les commentaires (liés aux posts & users)
            LikesSeeder::class,            // 4️⃣ Crée les likes (liés aux posts & users)
            ProfilUsersSeeder::class       // 5️⃣ Crée les profils utilisateurs (liés aux users)
        ]);

        // Exemple de création manuelle désactivé (utile pour test rapide)
        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
/* Ce fichier est le chef d’orchestre de tous tes seeders.
Il permet de remplir automatiquement toutes les tables nécessaires à ton projet avec des données fictives cohérentes.

✅ Ordre logique ici :
    UserSeeder → Crée les utilisateurs de base
    PostSeeder → Associe des posts aux utilisateurs
    CommentairesSeeder → Génère des commentaires sur les posts par des utilisateurs
    LikesSeeder → Simule des likes sur les posts
    ProfilUsersSeeder → Crée un profil avec biographie pour chaque utilisateur */
