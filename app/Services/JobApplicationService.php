<?php

namespace App\Services;

use App\Interfaces\JobApplicationRepositoryInterface;

class JobApplicationService
{
    private $uploadService;
    private $jobApplicationRepository;

    const PERMISSION_PARENT = 'job-applications';

    public function __construct(UploadService $uploadService, JobApplicationRepositoryInterface $jobApplicationRepository)
    {
        $this->uploadService = $uploadService;
        $this->jobApplicationRepository = $jobApplicationRepository;
    }

    public function all()
    {
        return $this->jobApplicationRepository->all();
    }

    public function create(array $data)
    {
        $data['resume'] = $this->uploadService->upload($data['resume']);
        return $this->jobApplicationRepository->create($data);
    }

    public function findById(string $id)
    {
        return $this->jobApplicationRepository->findById($id);
    }

    public function downloadResume(string $jobApplicationId)
    {
        $jobApplication = $this->jobApplicationRepository->findById($jobApplicationId);
        return $this->uploadService->download($jobApplication->resume);
    }

    public function delete(string $jobApplicationId)
    {
        $jobApplication = $this->jobApplicationRepository->findById($jobApplicationId);
        $this->uploadService->delete($jobApplication->resume);
        return $jobApplication->delete();
    }

    public function count()
    {
        return $this->jobApplicationRepository->count();
    }

    public function latest() {
        return $this->jobApplicationRepository->latest();
    }
}
