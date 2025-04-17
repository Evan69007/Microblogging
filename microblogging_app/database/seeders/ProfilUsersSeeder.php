<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents; // Optionnel : désactive les events pendant le seeding
use Illuminate\Database\Seeder;                            // Classe de base pour tous les seeders
use App\Models\Profil_Users;                               // Modèle pour la table `profil_users`

class ProfilUsersSeeder extends Seeder
{
    /**
     * Méthode exécutée automatiquement lors de :
     * php artisan db:seed --class=ProfilUsersSeeder
     */
    public function run(): void
    {
        // 📥 Lecture du fichier JSON contenant les données utilisateurs
        $jsonData = file_get_contents(database_path('data/users.json'));

        // 🔁 Décodage du JSON en tableau PHP associatif
        $data = json_decode($jsonData, true);

        // 🔁 Pour chaque utilisateur, on insère sa biographie dans la table `profil_users`
        for ($i = 0; $i < count($data); $i += 1)
        {
            $profil_user = Profil_Users::create([
                'user_id' => ($i + 1),                  // Associe la biographie à l’utilisateur i+1
                'biographie' => $data[$i]['biographie'] // Texte de la bio issu du JSON
            ]);
        }
    }
}

/*  Ce ProfilUsersSeeder permet d’importer les biographies personnalisées des utilisateurs à partir du même fichier JSON que pour les posts.
Il crée les enregistrements dans la table profil_users, qui est liée à la table users par une relation 1:1 (user_id unique).

✅ Pré-requis :
    Les utilisateurs doivent être créés avant ce seeder (ex. via UserSeeder)
    L’ordre de passage dans DatabaseSeeder.php est donc important*/