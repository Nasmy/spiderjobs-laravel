<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApplyRequest;
use App\Services\JobApplicationService;
use App\Services\JobService;
use App\Services\MailService;

class JobApplicationController extends Controller
{

    private $jobService;
    private $jobApplicationService;
    private $mailService;

    public function __construct(
        JobService $jobService,
        JobApplicationService $jobApplicationService,
        MailService $mailService
    )
    {
        $this->jobService = $jobService;
        $this->jobApplicationService = $jobApplicationService;
        $this->mailService = $mailService;
    }

    public function index()
    {
        $jobApplications = $this->jobApplicationService->all();
        return view('job.applications',[
            'jobApplications' => $jobApplications,
        ]);
    }

    public function store(ApplyRequest $request, string $applyUrl)
    {
        $data = $request->validated();
        $job = $this->jobService->findByApplyUrl($applyUrl);
        $data['job_id'] = $job->id;

        $application = $this->jobApplicationService->create($data);

        try {
            $this->mailService->sendJobAppliedMessage($application);
            $this->mailService->notifyAdmin($application);
        } catch (\Exception $e) {
            return redirect()->route('manage-applications')->with('errors', MailService::EMAIL_INTERNAL_SERVER_ERROR);
        }

        return back()->with('success', 'Your application sent successfully');
    }

    public function showApplyForm(string $jobApplyUrl)
    {
        $job = $this->jobService->findByApplyUrl($jobApplyUrl);

        return view('job.apply', ['job' => $job]);
    }

    public function show(string $jobApplicationId)
    {
        $jobApplication = $this->jobApplicationService->findById($jobApplicationId);

        return view('job.application-show', ['jobApplication' => $jobApplication]);
    }

    public function openJobs()
    {
        $jobs = $this->jobService->getOpenJobs();
        return view('job.open', ['jobs' => $jobs]);
    }

    public function downloadResume(string $jobApplicationId)
    {
        return $this->jobApplicationService->downloadResume($jobApplicationId);
    }

    public function destroy(string $jobApplicationId)
    {
        $this->jobApplicationService->delete($jobApplicationId);
        return back()->with('success', 'Job Application removed successfully');
    }
}
