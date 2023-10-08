<?php

namespace App\Repositories;

use App\Interfaces\DepartmentRepositoryInterface;
use App\Models\Department;

class DepartmentRepository implements DepartmentRepositoryInterface
{

    public function all()
    {
        return Department::all();
    }

    public function create(array $data)
    {
        return Department::create([
            'name' => $data['name'],
            'description' => $data['description'],
        ]);
    }

    public function update(string $id, array $data)
    {
        $department = Department::findOrFail($id);

        $department->update([
            'name' => $data['name'],
            'description' => $data['description'],
        ]);

        return $department;
    }

}