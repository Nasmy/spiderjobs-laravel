<?php

namespace Database\Seeders;

use App\Services\JobService;
use Illuminate\Database\Seeder;

class JobRelatedTablesSeeder extends Seeder
{

    private $jobService;

    public function __construct(JobService $jobService)
    {
        $this->jobService = $jobService;
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->seedJobCategories();
        $this->seedExperienceLevels();
        $this->seedEmploymentTypes();
    }

    private function seedJobCategories()
    {
        $jobCategories = $this->jobService->jobCategoryService->getAvailableCategories();
        foreach($jobCategories as $jobCategory) {
            $this->jobService->jobCategoryService->createOrUpdate($jobCategory);
        }
    }

    private function seedExperienceLevels()
    {
        $experienceLevels = $this->jobService->experienceService->getAvailableLevels();
        foreach($experienceLevels as $experienceLevel) {
            $this->jobService->experienceService->createOrUpdate($experienceLevel);
        }
    }

    private function seedEmploymentTypes()
    {
        $employmentTypes = $this->jobService->employmentTypeService->getAvailableEmploymentTypes();
        foreach($employmentTypes as $employmentType) {
            $this->jobService->employmentTypeService->createOrUpdate($employmentType);
        }
    }
}
