<?php
/**
 * @name CountryService
 *
 * @author Kanchana Fernando
 * @copyright Beyond Technologies (PVT) ltd
 */

namespace App\Services;

use App\Interfaces\CountryRepositoryInterface;
use App\Models\Country;
use App\Traits\ApiResponse;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;

/**
 * @description The class contain all business logics related with configurations
 */
class CountryService
{
    use ApiResponse;

    public $countryRepository;

    public function __construct(CountryRepositoryInterface $countryRepository)
    {
        $this->countryRepository = $countryRepository;
    }

    /**
     * @description retrive all configurations
     * @return mixed
     */
    public function all()
    {
        return $this->countryRepository->all();
    }

    /**
     * @description this is use for set configurations for configuration seeder
     * @return array[]
     */
    public static function getCountries(): array
    {
        return [
            [
                "country_code" => "us",
                "country_name" => "United States",
            ],

            [
                "country_code" => "fr",
                "country_name" => "France",
            ],

            [
                "country_code" => "lk",
                "country_name" => "Sri Lanka",
            ],

            [
                "country_code" => "ag",
                "country_name" => "United States",
            ],

            [
                "country_code" => "us",
                "country_name" => "Anguilla",
            ],

            [
                "country_code" => "al",
                "country_name" => "Albania",
            ],

            [
                "country_code" => "am",
                "country_name" => "Armenia",
            ],
            [
                "country_code" => "an",
                "country_name" => "Netherlands Antilles",
            ],
            [
                "country_code" => "ao",
                "country_name" => "Angola",
            ],
            [
                "country_code" => "ao",
                "country_name" => "Angola",
            ],
            [
                "country_code" => "ao",
                "country_name" => "Angola",
            ],
            [
                "country_code" => "ao",
                "country_name" => "Angola",
            ],
            [
                "country_code" => "ao",
                "country_name" => "Angola",
            ],
            [
                "country_code" => "ao",
                "country_name" => "Angola",
            ],
            [
                "country_code" => "ao",
                "country_name" => "Angola",
            ],
            [
                "country_code" => "ao",
                "country_name" => "Angola",
            ],
        ];
    }
}
