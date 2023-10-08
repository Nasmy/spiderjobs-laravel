<!DOCTYPE html>
<html
        lang="en"
        class="semi-style layout-navbar-fixed layout-menu-fixed"
        dir="ltr"
        data-theme="theme-semi-dark"
        data-assets-path="../../assets/"
        data-template="vertical-menu-template"
>
<head>
    <meta charset="utf-8" />
    <meta
            name="viewport"
            content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Available Jobs</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../../assets/img/favicon/favicon.ico" />
    @include('layouts/sections/style')

</head>

<body>
<div class="layout-wrapper">
    <div class="layout-container">
        <div class="layout-page">
            <div class="content-wrapper container">
                <div class="container-xxl flex-grow-1 container-p-y">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Job title</th>
                                <th>Application link</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($jobs as $job)
                            <tr>
                                <td>
                                    <p class="text-lg fw-bold">{{ $job->title }}</p>
                                </td>
                                <td>
                                    <a class="btn btn-outline-primary" href="{{ route('job-apply-form', ['applyUrl' => $job->job_apply_url])  }}">
                                        Apply
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('layouts/sections/script')
</body>
</html>
