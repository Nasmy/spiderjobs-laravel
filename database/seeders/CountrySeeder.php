<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Services\CountryService;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countryList = CountryService::getCountries();

        foreach ($countryList as $country) {
            $countrycode = $country['country_code'];
            $countryname = $country['country_name'];
            $this->createRecord($countrycode, $countryname );
         }
    }

    private function createRecord(string $countrycode, string $countryname)
    {
        Country::create([
            'country_code' => $countrycode,
            'country_name' => $countryname,
        ]);
    }
}
