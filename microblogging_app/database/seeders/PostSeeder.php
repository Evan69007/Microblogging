<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;

class PostSeeder extends Seeder
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
            foreach($data[$i]['posts'] as $post)
            {
                $post = Post::create([
                    'user_id' => ($i + 1),
                    'titre' => $post['titre'],
                    'description' => $post['description'],
                    'hashtags' => $post['hashtags'],
                ]);
            }
        }
    }
}
