<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Contracts\Repositories\RecipeRepositoryContract;
use App\Models\Recipe;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    public function __construct(
        protected RecipeRepositoryContract $recipeRepository,
    )
    {
    }

    public function index(Request $request): JsonResponse
    {
        return response()->json($this->recipeRepository->search(
            $request->query('search') ?? [],
            (int)$request->query('page', 1),
            (int)$request->query('limit', 5),
        ));
    }

    public function show(Request $request, Recipe $recipe): JsonResponse
    {
        return response()->json($recipe);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $this->validate($request, [
            'data.name' => 'required|min:3',
            'data.description' => 'required|min:3',
            'data.ingredients' => 'array',
            'data.author_email' => 'email',
            'data.steps' => 'array',
            'data.ingredients.*.qty' => 'required|integer|min:1',
            'data.ingredients.*.name' => 'required',
            'data.ingredients.*.unit' => 'required',
        ]);

        $recipe = $this->recipeRepository->create($validated['data']);
        return response()->json($recipe);
    }
}
