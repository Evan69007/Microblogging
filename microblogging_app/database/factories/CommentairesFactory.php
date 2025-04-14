<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
// use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Str;
use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Commentaires>
 */
class CommentairesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [

                'user_id'=> $this->faker->numberBetween(1, 4),
                'post_id'=>$this->faker->numberBetween(1, 10),
                'description'=>$this->faker->paragraph(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
        ];
    }
}
