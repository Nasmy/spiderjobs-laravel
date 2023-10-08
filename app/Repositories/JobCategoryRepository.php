<?php

namespace App\Repositories;

use App\Interfaces\JobCategoryRepositoryInterface;
use App\Models\JobCategory;

class JobCategoryRepository implements JobCategoryRepositoryInterface
{
    public function all()
    {
        return JobCategory::all();
    }

    public function findByName($name)
    {
        return JobCategory::where('name', $name)->get();
    }

    public function findById($id)
    {
        return JobCategory::findOrFail($id);
    }

    public function createOrUpdate($id = null, $data = []): JobCategory
    {
        return JobCategory::updateOrCreate(['id' => $id], $data);
    }

    public function delete($id)
    {
        return JobCategory::findOrFail($id)->delete();
    }
}
