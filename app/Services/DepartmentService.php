<?php

namespace App\Services;

use App\Interfaces\DepartmentRepositoryInterface;

/**
 * @description The class contain all business logics related with Departments
 */
class DepartmentService
{

    private DepartmentRepositoryInterface $departmentRepository;

    public function __construct(DepartmentRepositoryInterface $departmentRepository)
    {
        $this->departmentRepository = $departmentRepository;
    }

    public function all()
    {
    return $this->departmentRepository->all();
    }

    public function createOrUpdate(array $data, $id = null)
    {
        if($id) {
            return $this->update($id, $data);
        }

        return $this->create($data);
    }

    public function update(string $id, array $data)
    {
        return $this->departmentRepository->update($id, $data);
    }

    public function create(array $data)
    {
        return $this->departmentRepository->create($data);
    }

    /**
     * @description this is use for set departments for department seeder
     * @return array[]
     */
    public static function getAvailableDepartments(): array
    {
        return [
            [
                "name" => "Human Capital",
                "description" => "Human Capital",
            ],
            [
                "name" => "Finance and admin",
                "description" => "Finance and admin",
            ],
            [
                "name" => "Operation",
                "description" => "Operation",
            ],
            [
                "name" => "Production",
                "description" => "Production",
            ],
            [
                "name" => "Sales",
                "description" => "Sales",
            ],
        ];
    }
}