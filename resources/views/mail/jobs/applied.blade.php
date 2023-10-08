@component('mail::message')
Hello {{ $jobApplication->first_name }},

Thank you for your interest in joining us; we're happy to hear from you! 🙌
We've received your application and are currently reviewing them all. Once we have some news, we will get back to you once with more information.

Have a great day! 🔆

Thanks,<br>
{{ config('app.name') }}
@endcomponent
