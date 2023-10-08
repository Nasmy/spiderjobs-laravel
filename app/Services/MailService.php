<?php

namespace App\Services;

use App\Mail\JobApplied;
use App\Mail\ResumeReceived;
use App\Models\JobApplication;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class MailService
{
    public $configurationService;
    const EMAIL_INTERNAL_SERVER_ERROR = "There is an error with mail server";
    public function __construct(ConfigurationService $configurationService)
    {
        $this->configurationService = $configurationService;
    }

    public function sendJobAppliedMessage(JobApplication $jobApplication)
    {
        Mail::to(User::factory()->make([
            'first_name' => $jobApplication->first_name,
            'last_name' => $jobApplication->first_last,
            'email' => $jobApplication->email,
        ]))->send(new JobApplied($jobApplication));
    }

    public function notifyAdmin(JobApplication $jobApplication)
    {
        Mail::to(User::factory()->make([
            'email' => $this->configurationService->getAdminEmail(),
        ]))->send(new ResumeReceived($jobApplication));
    }
}
