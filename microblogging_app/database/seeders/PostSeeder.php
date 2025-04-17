<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents; // Optionnel : désactive les événements du modèle durant le seeding
use Illuminate\Database\Seeder;                            // Classe de base de tous les seeders
use App\Models\Post;                                       // Modèle Post pour insérer les données

class PostSeeder extends Seeder
{
    /**
     * Exécute le seeder lors de la commande :
     * php artisan db:seed --class=PostSeeder
     */
    public function run(): void
    {
        // 📥 Lecture du fichier JSON contenant les utilisateurs et leurs posts
        $jsonData = file_get_contents(database_path('data/users.json'));

        // 📊 Décodage du JSON en tableau PHP associatif
        $data = json_decode($jsonData, true);

        // 🔁 Boucle sur chaque utilisateur
        for ($i = 0; $i < count($data); $i += 1)
        {
            // 🔁 Pour chaque post associé à cet utilisateur
            foreach($data[$i]['posts'] as $post)
            {
                // Création d’un nouveau post dans la BDD
                Post::create([
                    'user_id' => ($i + 1),               // Associe le post à l’utilisateur n°i+1
                    'titre' => $post['titre'],           // Titre du post
                    'description' => $post['description'], // Description du post
                    'hashtags' => $post['hashtags'],     // Hashtags sous forme de tableau (stockés en JSON)
                ]);
            }
        }
    }
}

/* Ce seeder permet de générer les publications (posts) de chaque utilisateur à partir d’un fichier JSON externe (database/data/users.json).
Il rend tes données de démo plus réalistes et personnalisées au lieu de dépendre d’une factory aléatoire.

✅ Ce qu’il faut vérifier :
    Les utilisateurs sont déjà créés avant ce seeder (sinon user_id ne correspondra pas)
    Les hashtags sont bien stockés en JSON (champ json dans ta migration ✅)*/