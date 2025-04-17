<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents; // Optionnel : permet de désactiver les events pendant le seed
use Illuminate\Database\Seeder;                            // Classe de base pour tous les seeders
use App\Models\Likes;                                      // Modèle Likes

class LikesSeeder extends Seeder
{
    /**
     * Méthode exécutée lors du seed :
     * php artisan db:seed --class=LikesSeeder
     */
    public function run(): void
    {
        // Crée 10 enregistrements dans la table `likes`
        // Chaque enregistrement représente un "like" entre un user et un post
        Likes::factory(10)->create();
    }
}
/* 

Ce seeder permet de pré-remplir la table likes avec des données fictives :
    Il simule les interactions entre utilisateurs et publications
    Il est utile pour tester l’affichage du nombre de likes, les boutons ❤️, ou les fonctionnalités de type "liké ou pas"

✅ Ce qu’il génère :
Colonne	Contenu généré par la factory
user_id	Un utilisateur entre 1 et 4
post_id	Un post entre 1 et 10
timestamps	Date de like */