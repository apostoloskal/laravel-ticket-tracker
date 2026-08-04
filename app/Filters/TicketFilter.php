<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class TicketFilter
{
    protected array $filters = [
        'status'   => StatusFilter::class,
        'category' => CategoryFilter::class,
        'search'   => SearchFilter::class,
    ];

    public function apply(Builder $query, Request $request): Builder
    {
        foreach ($this->filters as $filterName => $strategyClass) {
            
            if ($request->filled($filterName)) {
                
                $strategy = new $strategyClass();
                
                $query = $strategy->apply($query, $request->input($filterName));
            }
        }

        return $query;
    }
}