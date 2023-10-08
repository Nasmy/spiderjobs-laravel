<?php

namespace App\Interfaces;

interface ExperienceRepositoryInterface
{

    public function all();
    public function create(array $data);
    public function update(string $id, array $data);
}