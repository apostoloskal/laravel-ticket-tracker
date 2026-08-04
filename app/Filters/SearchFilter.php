<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class SearchFilter implements FilterStrategy
{
    public function apply(Builder $query, mixed $value): Builder
    {
        return $query->where(function ($q) use ($value) {
            $q->where('tracking_code', 'like', "%{$value}%")
              ->orWhere('title', 'like', "%{$value}%");
        });
    }
}