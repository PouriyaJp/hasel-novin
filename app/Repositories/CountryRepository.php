<?php

namespace App\Repositories;

use App\Models\Country;
use Illuminate\Support\Facades\Cache;

class CountryRepository
{
    protected $model;

    public function __construct(Country $country)
    {
        $this->model = $country;
    }

    public function all()
    {
        return Cache::remember('countries', 60 * 60, function () {
            return $this->model->all();
        });
    }

    public function search($query)
    {
        return Cache::remember("countries_search_{$query}", 60 * 60, function () use ($query) {
            return $this->model->where('name_en', 'LIKE', "%{$query}%")
                ->orWhere('name_fa', 'LIKE', "%{$query}%")
                ->get();
        });
    }
}
