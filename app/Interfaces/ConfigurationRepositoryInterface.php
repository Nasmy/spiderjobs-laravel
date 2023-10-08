<?php

namespace App\Interfaces;

interface ConfigurationRepositoryInterface
{
    public function all();
    public function findByKey($key);
    public function findByConfigKey($key);
    public function findById($id);
    public function createOrUpdate($id, $data);
    public function delete($id);
}

