@inject('authService', 'App\Services\AuthService')
@php
    $role_id = \Illuminate\Support\Facades\Auth::user()->role_id;
@endphp
@extends('layouts.main-base')

@section('title', 'Jobs - Apps')

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
            <h4 class="py-3 breadcrumb-wrapper mb-2">Jobs List</h4>
            @if(Session::has('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
            @endif
            <div class="row g-4">
                @if($authService->checkAuthorize($role_id, \App\Services\PermissionService::concatPermissions(\App\Services\JobService::PERMISSION_PARENT,\App\Services\PermissionService::PERMISSION_CREATE)))
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
                                <div class="col-sm-7">
                                    <div class="card-body text-sm-end text-center ps-sm-0">
                                        <a class="btn btn-primary mb-3 text-nowrap add-new-role"
                                           href="{{route('job-create')}}">
                                            Add New Job
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            @endif
            <!-- Bootstrap Dark Table -->
                <div class="card">
                    <h5 class="card-header">Jobs Table</h5>
                    <div class="table-responsive text-nowrap">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Title</th>
                                <th>Department</th>
                                <th>Employment Type</th>
                                <th>Expiry Date</th>
                                <th>Category</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                            @foreach($jobs as $job)
                                <tr>
                                    <td>{{ $job->title }}</td>
                                    <td>
                                        {{ $job->department->name }}
                                    </td>
                                    <td>{{$job->employmentType->name}}</td>
                                    <td>{{ $job->expires_at }}</td>
                                    <td>{{ $job->category->name }}</td>
                                    <td>
                                        <div class="d-flex">
                                            @if($authService->checkAuthorize($role_id, \App\Services\PermissionService::concatPermissions(\App\Services\JobService::PERMISSION_PARENT,\App\Services\PermissionService::PERMISSION_EDIT)))
                                                <a class="dropdown-item w-auto"
                                                   href="{{ route('job-edit', ['id' => $job->id]) }}"
                                                ><i class="bx bx-edit-alt me-1"></i>Edit</a>
                                            @endif
                                            @if($authService->checkAuthorize($role_id, \App\Services\PermissionService::concatPermissions(\App\Services\JobService::PERMISSION_PARENT,\App\Services\PermissionService::PERMISSION_VIEW)))
                                                <a class="dropdown-item w-auto"
                                                   href="{{ route('job-show', ['id' => $job->id]) }}"
                                                ><i class="bx bx-link-external me-1"></i>Show</a>
                                            @endif
                                            @if($authService->checkAuthorize($role_id, \App\Services\PermissionService::concatPermissions(\App\Services\JobService::PERMISSION_PARENT,\App\Services\PermissionService::PERMISSION_DELETE)))
                                                <form id="delete-job-form-id-{{ $job->id }}" method="POST"
                                                      action="{{ route('job-destroy', ['id' => $job->id ]) }}">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="dropdown-item delete-job"
                                                            data-id="{{ $job->id }}">
                                                        <i class="bx bx-trash me-1"></i> Delete
                                                    </button>
                                                </form>
                                            @endif
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
                $('.delete-job').on('click', function (e) {
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
                        if (result.isConfirmed) {
                            $(form).submit();
                        }
                    });
                });
            </script>
@endsection
