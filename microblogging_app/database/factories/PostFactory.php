<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Carbon\Carbon;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'created_at' => Carbon::now(),
            'user_id'=> $this->faker->numberBetween(1, 10),
            'titre'=>$this->faker->sentence(),
            'description'=>$this->faker->paragraph(),
            'hashtags'=>$this->faker->randomElements(
                ['#tech', '#code', '#laravel', '#php', '#opensource', '#ada', '#devlife'],
                rand(1, 4)
            ),
        ];
    }
}
