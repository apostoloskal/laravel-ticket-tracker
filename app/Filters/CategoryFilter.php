<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class CategoryFilter implements FilterStrategy
{
    public function apply(Builder $query, mixed $value): Builder
    {
        return $query->where('category', $value);
    }
}