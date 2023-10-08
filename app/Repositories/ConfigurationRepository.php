<?php

namespace App\Repositories;

use App\Interfaces\ConfigurationRepositoryInterface;
use App\Models\Configuration;
use Illuminate\Support\Facades\DB;

class ConfigurationRepository implements ConfigurationRepositoryInterface
{
    public function all()
    {
        return Configuration::all();
    }

    public function findByKey($key)
    {
        return Configuration::where('configuration_key', $key)->get();
    }

    public function findByConfigKey($key)
    {
        return Configuration::where('configuration_key', $key)->get()->first();
    }

    public function findById($id)
    {
        return Configuration::findOrFail($id);
    }

    public function createOrUpdate($id = null, $data = []): Configuration
    {
        $config = Configuration::updateOrCreate(['id' => $id], $data);
        return $config;
    }

    public function delete($id)
    {
        $config = Configuration::findOrFail($id);
        return $config->delete();
    }
}
