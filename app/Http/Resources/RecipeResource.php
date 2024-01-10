<?php
declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RecipeResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->resource->id,
            'slug' => $this->resource->slug,
            'name' => $this->resource->name,
            'author_email' => $this->resource->author_email,
            'description' => $this->resource->description,
            'ingredients' => $this->resource->ingredients,
            'steps' => $this->resource->steps,
            'images' => $this->resource->images,
        ];

    }
}
