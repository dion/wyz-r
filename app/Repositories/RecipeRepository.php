<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Contracts\Repositories\RecipeRepositoryContract;
use App\Models\Recipe;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;
use Psr\Log\LoggerInterface;

/**
 * @property Recipe $model
 */
class RecipeRepository extends AbstractRepository implements RecipeRepositoryContract
{
    public function __construct(Recipe $model, LoggerInterface $log)
    {
        parent::__construct($model, $log);
    }
    public function create(array $data = []): Model
    {
        $data['slug'] = Str::slug($data['name']) . '-' . Str::random(5);

        $images = [];
        $k = 0;
        while ($k < rand(1, 5)) {
            $images[] = 'https://placekitten.com/' . rand(1, 5) * 100 . '/' . rand(1, 5) * 100;
            ++$k;
        }
        $data['images'] = $images;
        return Recipe::create($data);
    }

    public function search(array $parameters, int $page = 1, int $limit = 15): LengthAwarePaginator
    {
        $email  = $parameters['author_email'] ?? null;
        $keywords = $parameters['keywords'] ?? null;
        $ingredients = $parameters['ingredients'] ?? null;

        $query = $this->model->newQuery();
        if (!empty($email)) {
            $query->where('author_email', $email);
        }

        if (!empty($keywords)) {
            foreach ($keywords as $keyword) {
                $query->where(function (Builder $query) use ($keyword) {
                    $query->where('name', 'like', "%{$keyword}%")
                        ->orWhere('description', 'like', "%{$keyword}%")
                        ->orWhere('ingredients', 'like', "%{$keyword}%")
                        ->orWhere('steps', 'like', "%{$keyword}%");
                });
            }
        }

        if (!empty($ingredients)) {
            foreach ($ingredients as $ingredient) {
                $query->where(function (Builder $query) use ($ingredient) {
                    $query->where('ingredients', 'like', "%{$ingredient}%");
                });
            }
        }
        return $query->paginate($limit, ['*'], 'page', $page)->appends(['search' => $parameters]);
    }
}
