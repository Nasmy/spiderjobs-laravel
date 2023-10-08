@extends('layouts.main-base')

@section('title', 'Jobs Applications - Apps')

@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="card">
                <h5 class="card-header">Candidate Application</h5>
                <div class="table-responsive text-nowrap">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Job</th>
                            <th>Candidate Name</th>
                            <th>Candidate Email</th>
                            <th>Candidate Mobile</th>
                            <th>Application Date</th>
                        </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            <tr>
                                <td>
                                    <a href="{{ route('job-show', ['id' => $jobApplication->job->id]) }}" target="_blank" rel="noopener">
                                        {{ $jobApplication->job->title }}
                                    </a>
                                </td>
                                <td>{{ $jobApplication->full_name }}</td>
                                <td>{{ $jobApplication->email }}</td>
                                <td>{{ $jobApplication->mobile }}</td>
                                <td>{{ $jobApplication->created_at }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card mt-1">
                <h5 class="card-header">Cover letter</h5>
                <p class="p-4">{{ $jobApplication->cover_letter }}</p>
            </div>
            <div>
                <iframe style="width: 100%; height: 80vh" src="{{ asset('/laraview/#../storage/' . $jobApplication->resume) }}"></iframe>
            </div>
        </div>
    </div>
@endsection
