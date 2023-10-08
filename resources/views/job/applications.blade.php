@inject('authService', 'App\Services\AuthService')
@php
    $role_id = \Illuminate\Support\Facades\Auth::user()->role_id;
@endphp
@extends('layouts.main-base')

@section('title', 'Jobs Applications - Apps')

@section('vendor-style')
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/sweetalert2/sweetalert2.css')}}"/>
@endsection

@section('vendor-script')
    <script src="{{asset('assets/vendor/libs/sweetalert2/sweetalert2.js')}}"></script>
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="py-3 breadcrumb-wrapper mb-2">Jobs Applications List</h4>
            @if(Session::has('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
            @endif
            @if(Session::has('errors'))
                <div class="alert alert-danger">
                    {{ Session::get('errors') }}
                </div>
        @endif
            {{--<div class="row g-4">
                <div class="col-xl-4 col-lg-6 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-2">
                                <h6 class="fw-normal">Total {{ $jobApplications->count() }}</h6>
                            </div>
                            <div class="d-flex justify-content-between align-items-end">
                                <div class="role-heading">
                                    <h4 class="mb-1">Job Applications</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-6">
                    <div class="card h-100">
                        <div class="row h-100">
                            <div class="col-sm-5">
                                <div class="d-flex align-items-end h-100 justify-content-center mt-sm-0 mt-3">
                                    <img
                                            src="../../assets/img/illustrations/lady-with-laptop-light.png"
                                            class="img-fluid"
                                            alt="Image"
                                            width="100"
                                            data-app-light-img="illustrations/lady-with-laptop-light.png"
                                            data-app-dark-img="illustrations/lady-with-laptop-dark.png"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>--}}
                <!-- Bootstrap Dark Table -->
                <div class="card">
                    <h5 class="card-header">Job Applications Table</h5>
                    <div class="table-responsive text-nowrap">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Job</th>
                                <th>Candidate Name</th>
                                <th>Candidate Email</th>
                                <th>Application Date</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                            @foreach($jobApplications as $jobApplication)
                                <tr>
                                    <td>
                                        <a href="{{ route('job-show', ['id' => $jobApplication->job->id]) }}" target="_blank" rel="noopener">
                                            {{ $jobApplication->job->title }}
                                        </a>
                                    </td>
                                    <td>{{ $jobApplication->full_name }}</td>
                                    <td>{{ $jobApplication->email }}</td>
                                    <td>{{ $jobApplication->created_at }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <a class="dropdown-item w-auto" href="{{ route('manage-applications-show', ['id' => $jobApplication->id]) }}"
                                            ><i class="bx bx-link-external me-1"></i>Show</a>
                                            <a class="dropdown-item w-auto" href="{{ route('download-resume', ['jobApplicationId' => $jobApplication->id]) }}"
                                            ><i class="bx bx-download me-1"></i>Resume</a>
                                            <form method="POST" action="{{ route('manage-applications-destroy', ['id' => $jobApplication->id ]) }}">
                                                @csrf
                                                @method('delete')
                                                <button  type="submit" class="dropdown-item w-auto delete" data-id="{{ $jobApplication->id }}">
                                                    <i class="bx bx-trash me-1"></i> Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!--/ Bootstrap Dark Table -->
            </div>
        </div>
        @endsection


        @section('page-script')
            <script>
                $('.delete').on('click', function (e) {
                    e.preventDefault();
                    var form = $(this).parents('form:first');
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, delete it!',
                        customClass: {
                            confirmButton: 'btn btn-primary me-3',
                            cancelButton: 'btn btn-label-secondary'
                        },
                        buttonsStyling: false
                    }).then(function (result) {
                        if(result.isConfirmed) {
                            $(form).submit();
                        }
                    });
                });
            </script>
@endsection
