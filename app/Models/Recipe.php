<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'ingredients',
        'steps',
        'author_email',
        'images',
    ];

    protected $casts = [
        'ingredients' => 'array',
        'steps' => 'array',
        'images' => 'array',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

}
