<?php

namespace App\Interfaces;

interface DepartmentRepositoryInterface
{
    public function all();
    public function create(array $data);
    public function update(string $id, array $data);
}