<?php

namespace App\Services;

use App\Interfaces\EmploymentTypeRepositoryInterface;

class EmploymentTypeService
{

    private $employmentTypeRepository;

    const PERMISSION_PARENT = 'employment-status';

    public function __construct(EmploymentTypeRepositoryInterface $employmentTypeRepository)
    {
        $this->employmentTypeRepository = $employmentTypeRepository;
    }

    public function all()
    {
        return $this->employmentTypeRepository->all();
    }

    public function createOrUpdate(array $data, $id = null)
    {
        if($id) {
            return $this->update($id, $data);
        }

        return $this->create($data);
    }

    public function create(array $data)
    {
        return $this->employmentTypeRepository->create($data);
    }

    public function update(string $id, array $data)
    {
        return $this->employmentTypeRepository->update($id, $data);
    }
    public function getAvailableEmploymentTypes()
    {
        return [
            [
                'name' => 'Full Time',
                'description' => 'Full Time',
            ],
            [
                'name' => 'Part time',
                'description' => 'Part time',
            ],
            [
                'name' => 'Contract',
                'description' => 'Contract',
            ],
            [
                'name' => 'Internship',
                'description' => 'Internship',
            ],
            [
                'name' => 'Temporary',
                'description' => 'Temporary',
            ],
            [
                'name' => 'Volunteer',
                'description' => 'Volunteer',
            ],
            [
                'name' => 'Other',
                'description' => 'Other',
            ],
        ];
    }
}
