<?php

namespace App\Mail;

use App\Models\JobApplication;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class ResumeReceived extends Mailable
{
    use Queueable, SerializesModels;

    private  JobApplication $jobApplication;

    public function __construct(JobApplication $jobApplication)
    {
        $this->jobApplication = $jobApplication;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $path = storage_path('app' . DIRECTORY_SEPARATOR . $this->jobApplication->resume);

        return $this->markdown('mail.jobs.resume-received', [
            'jobApplication' => $this->jobApplication
        ])->attach($path, [
            'as' => 'resume',
            'mime' => 'application/pdf',
        ]);
    }
}
