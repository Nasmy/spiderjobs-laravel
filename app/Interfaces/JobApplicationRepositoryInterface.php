<?php

namespace App\Interfaces;

interface JobApplicationRepositoryInterface
{
    public function all();
    public function create(array $data);
    public function findById(string $id);
    public function count();
    public function latest();
}
