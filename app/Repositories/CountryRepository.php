<?php

namespace App\Repositories;

use App\Interfaces\CountryRepositoryInterface;
use App\Models\Country;
use Illuminate\Support\Facades\DB;

class CountryRepository implements CountryRepositoryInterface
{
    public function all()
    {
        return Country::all();
    }

  
}
