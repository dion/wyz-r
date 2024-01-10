<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class RecipeFactory extends Factory
{
    public function definition(): array
    {
        $name = fake()->words(rand(1, 3), true);
        $k = 0;
        $ingredients = [];
        while ($k < rand(3, 10)) {
            $ingredients[] = [
                'qty' => rand(3, 15),
                'unit' => fake()->word,
                'name' => fake()->words(rand(1, 3), true),
            ];
            ++$k;
        }

        return [
            'name' => $name,
            'slug' => Str::slug($name) . '-' . Str::random(5),
            'author_email' => fake()->safeEmail(),
            'description' => fake()->sentences(rand(3, 15), true),
            'ingredients' => $ingredients,
            'steps' => fake()->sentences(rand(5, 15)),
        ];
    }
}
