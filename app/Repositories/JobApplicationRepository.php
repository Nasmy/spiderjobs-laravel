<?php

namespace App\Repositories;

use App\Interfaces\JobApplicationRepositoryInterface;
use App\Models\JobApplication;

class JobApplicationRepository implements JobApplicationRepositoryInterface
{
    public function all()
    {
        return JobApplication::all();
    }

    public function create(array $data)
    {
        return JobApplication::create($data);
    }

    public function findById(string $id)
    {
        return JobApplication::findOrFail($id);
    }

    public function count()
    {
        return JobApplication::count();
    }

    public function latest()
    {
        return JobApplication::latest('created_at')->take(5)->get();
    }
}
