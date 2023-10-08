<?php

namespace App\Repositories;

use App\Interfaces\EmploymentTypeRepositoryInterface;
use App\Models\EmploymentType;
use App\Utils\ID;

class EmploymentTypeRepository implements EmploymentTypeRepositoryInterface
{

    public function all()
    {
        return EmploymentType::all();
    }

    public function create(array $data)
    {
        return EmploymentType::create([
            'name' => $data['name'],
            'ident' => ID::fromString($data['name']),
            'description' => $data['description'],
        ]);
    }

    public function update(string $id, array $data)
    {
        $employmentType = EmploymentType::findOrFail($id);

        if(isset($data['name'])) {
            $data['ident'] = ID::fromString($data['name']);
        }

        return $employmentType->update($data);
    }

}