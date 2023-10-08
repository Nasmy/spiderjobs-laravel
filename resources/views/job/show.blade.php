@extends('layouts.main-base')

@section('title', 'Job - Apps')

@section('content')
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-xl">
                <div class="card mb-4 p-4">
                    <div class="my-2">
                        <p class="fw-bold p-0 m-0">Job Title: </p>
                        <p>{{ $job->title }}</p>
                    </div>
                    <div class="my-2">
                        <p class="fw-bold p-0 m-0">Description:</p>
                        <div>{!! $job->description !!}</div>
                    </div>

                    <div class="my-2">
                        <p class="fw-bold p-0 m-0">Application URL:</p>
                        <a href="{{ route('job-apply-form', ['applyUrl' => $job->job_apply_url]) }}">{{ route('job-apply-form', ['applyUrl' => $job->job_apply_url]) }}</a>
                    </div>
                    <div class="my-2">
                        <p class="fw-bold p-0 m-0">Job Category:</p>
                        <p>{{ $job->category->name }}</p>
                    </div>
                    <div class="my-2">
                        <p class="fw-bold p-0 m-0">Department:</p>
                        <p>{{ $job->department->name }}</p>
                    </div>
                    <div class="my-2">
                        <p class="fw-bold p-0 m-0">Country:</p>
                        <p>{{ $job->country }}</p>
                    </div>
                    <div class="my-2">
                        <p class="fw-bold p-0 m-0">Work Place Type:</p>
                        <p>{{ $job->work_place_type }}</p>
                    </div>
                    <div class="my-2">
                        <p class="fw-bold p-0 m-0">Experience Level:</p>
                        <p>{{ $job->experienceLevel->name }}</p>
                    </div>
                    <div class="my-2">
                        <p class="fw-bold p-0 m-0">Employment Type:</p>
                        <p>{{ $job->employmentType->name }}</p>
                    </div>
                    <div class="my-2">
                        <p class="fw-bold p-0 m-0">Expiration Date</p>
                        <p>{{ $job->expiration_at }}</p>
                    </div>
                    <div class="my-2">
                        <p class="fw-bold p-0 m-0">Job Status:</p>
                        <p>{{ $job->status == '1' ? 'Active' : 'Inactive' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <!-- Content wrapper -->
@endsection