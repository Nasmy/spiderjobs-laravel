<?php

namespace Database\Seeders;

use App\Services\DepartmentService;
use Illuminate\Database\Seeder;

class DepartmentTableSeeder extends Seeder
{

    private $departmentService;

    public function __construct(DepartmentService $departmentService)
    {
      $this->departmentService = $departmentService;
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $departments = $this->departmentService->getAvailableDepartments();

        foreach($departments as $department) {
            $this->departmentService->createOrUpdate($department);
        }
    }

}
