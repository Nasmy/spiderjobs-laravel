<?php

namespace Database\Seeders;

use App\Models\Configuration;
use App\Services\ConfigurationService;
use Illuminate\Database\Seeder;

class ConfigurationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $configurationList = ConfigurationService::getConfigurations();

        foreach ($configurationList as $configuration) {
            $key = $configuration['configuration_key'];
            $value = $configuration['configuration_value'];
            $this->createRecord($key, $value );
         }
    }

    private function createRecord(string $key, string $value)
    {
        Configuration::create([
            'configuration_key' => $key,
            'configuration_value' => $value,
        ]);
    }
}
