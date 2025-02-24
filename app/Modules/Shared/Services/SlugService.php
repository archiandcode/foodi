<?php

namespace App\Modules\Shared\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class SlugService
{
    public function generate(Model $model, string $value): string
    {
        $baseSlug = Str::slug($value);
        $slug = $baseSlug;
        $i = 1;

        while(
        $model->newQuery()
            ->where('slug', $slug)
            ->when($model->exists, fn($query) => $query->whereKeyNot($model->getKey()))
            ->exists()
        ) {
            $slug = $baseSlug . '-' . $i++;
        }

        return $slug;
    }
}
