<?php

namespace App\Interfaces;

interface JobCategoryRepositoryInterface
{
    public function all();
    public function findByName($name);
    public function findById($id);
    public function createOrUpdate($id, $data);
    public function delete($id);
}

