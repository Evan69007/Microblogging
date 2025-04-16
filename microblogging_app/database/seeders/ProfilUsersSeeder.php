<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Profil_Users;

class ProfilUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jsonData = file_get_contents(database_path('data/users.json'));

        $data = json_decode($jsonData, true);

        for ($i = 0; $i < count($data); $i += 1)
        {
            $profil_user = Profil_Users::create([
                'user_id' => ($i + 1),
                'biographie' => $data[$i]['biographie'],
            ]);
        }
    }
}
