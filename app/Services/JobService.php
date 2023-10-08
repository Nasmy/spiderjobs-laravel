<?php
/**
 * @name JobService
 *
 * @author Nasser
 * @copyright Beyond (Pvt) Ltd
 */

namespace App\Services;

use App\Interfaces\JobRepositoryInterface;
use App\Utils\ID;
use Illuminate\Support\Facades\Auth;

class JobService
{
    public $jobCategoryService;
    public $experienceService;
    public $employmentTypeService;
    public $authService;
    private $jobRepository;

    const PERMISSION_PARENT = 'jobs';

    public function __construct(
        JobCategoryService     $jobCategoryService,
        ExperienceService      $experienceService,
        EmploymentTypeService  $employmentTypeService,
        JobRepositoryInterface $jobRepository,
        AuthService $authService
    )
    {
        $this->jobCategoryService = $jobCategoryService;
        $this->experienceService = $experienceService;
        $this->employmentTypeService = $employmentTypeService;
        $this->jobRepository = $jobRepository;
        $this->authService = $authService;
    }

    public function all()
    {
        $currentUser = Auth::user();
        return ($this->authService->isAdmin($currentUser->id))
            ? $this->jobRepository->all()
            : $this->findByCreatedUser($currentUser->id);
    }

    public function findByCreatedUser($userId) {
        return $this->jobRepository->findByCreatedUser($userId);
    }

    public function create(array $data)
    {
        $data['job_apply_url'] = $this->generateApplyUrl($data['title']);
        return $this->jobRepository->create($data);
    }

    public function update(string $id, array $data)
    {
        return $this->jobRepository->update($id, $data);
    }

    public function findById(string $id)
    {
        return $this->jobRepository->findById($id);
    }

    public function findByApplyUrl(string $applyUrl)
    {
        return $this->jobRepository->findByApplyUrl($applyUrl);
    }

    public function getOpenJobs()
    {
        return $this->jobRepository->open();
    }

    public function delete(string $id)
    {
        return $this->jobRepository->delete($id);
    }

    private function generateApplyUrl(string $value): string
    {
        $result = ID::fromString($value) . '-' . bin2hex(random_bytes(10));
        return $result;
    }

    public function jobCount()
    {
        return $this->jobRepository->getCount();
    }

    public function latestJob()
    {
        $latestJob = $this->jobRepository->getLatest();
        return (!empty($latestJob)) ? $latestJob : [];
    }

    public function recentJobs()
    {
        return $this->jobRepository->getRecent();
    }
}
