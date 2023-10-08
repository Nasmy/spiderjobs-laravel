<?php

namespace App\Http\Controllers;

use App\Services\JobApplicationService;
use App\Services\JobService;

class DashboardController extends Controller
{
    private $jobService;
    private $jobApplicationService;

    public function __construct(JobService $jobService, JobApplicationService $jobApplicationService)
    {
        $this->jobService = $jobService;
        $this->jobApplicationService = $jobApplicationService;
    }

    public function index() {
        return view('dashboard.dash', [
            'latestJobApplication' => $this->jobApplicationService->latest(),
            'jobApplicationCount' => $this->jobApplicationService->count(),
            'jobsCount' => $this->jobService->jobCount(),
            'latestJob' => $this->jobService->latestJob(),
            'jobs' => $this->jobService->recentJobs()
        ]);
    }
}
