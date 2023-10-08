<?php

namespace App\Interfaces;

interface EmploymentTypeRepositoryInterface
{
    public function all();
    public function create(array $data);
    public function update(string $id, array $data);
}