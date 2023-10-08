@component('mail::message')
Hello,

You got a new job application for <a href="{{ route('job-show', ['id' => $jobApplication->job->id ]) }}">{{ $jobApplication->job->title }}</a>

The resume is attached to this email.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
