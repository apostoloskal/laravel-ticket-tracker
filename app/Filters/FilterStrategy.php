<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

interface FilterStrategy
{
    /**
     * Apply the filter to the query builder.
     */
    public function apply(Builder $query, mixed $value): Builder;
}