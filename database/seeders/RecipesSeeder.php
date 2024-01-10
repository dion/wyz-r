<?php
declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Recipe;
use Illuminate\Database\Seeder;

class RecipesSeeder extends Seeder
{
    public function run(): void
    {
        $k = 0;
        while ($k < 100) {
            $recipe = Recipe::factory()->create();
            $recipe->save();
            ++$k;
        }
    }
}
