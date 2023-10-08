@inject('authService', 'App\Services\AuthService')
@php
    $role_id = \Illuminate\Support\Facades\Auth::user()->role_id;
@endphp
@extends('layouts.main-base')
@section('title', 'Roles - Apps')
@section('vendor-style')
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/formvalidation/dist/css/formValidation.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/sweetalert2/sweetalert2.css')}}"/>
@endsection

@section('vendor-script')
    <script src="{{asset('assets/vendor/libs/datatables/jquery.dataTables.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/datatables-responsive/datatables.responsive.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.js')}}"></script>

    <script src="{{asset('assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/sweetalert2/sweetalert2.js')}}"></script>
@endsection

@section('content')
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 breadcrumb-wrapper mb-2">Roles List</h4>
        @if(Session::has('role-creation-success'))
            <div class="alert alert-success">
                {{ Session::get('role-creation-success') }}
            </div>
        @endif
        <p>
            A role provided access to predefined menus and features so that depending on <br/>
            assigned role an administrator can have access to what user needs.
        </p>
        <!-- Role cards -->
        <div class="row g-4">
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
                                <a href="{{route('role-create')}}"
                                    class="btn btn-primary mb-3 text-nowrap add-new-role"
                                >
                                    Add New Role
                                </a>
                                <p class="mb-0">Add role, if it does not exist</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <!-- Role Table -->
                <!-- Basic Bootstrap Table -->
                <div class="card">
                    <h5 class="card-header">Role List</h5>
                    <div class="table-responsive text-nowrap">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                            @foreach ($roleLists as $role)
                                <tr>
                                    <td><strong>{{$role->name}}</strong></td>
                                    <td>{{$role->description}}</td>
                                    <td>
                                        <span class="badge {{ !!$role->active ? 'bg-label-primary' : 'bg-label-danger' }} me-1">
                                            {{ !!$role->active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <a class="dropdown-item w-auto" href="{{ route('role-edit', ['id' => $role->id]) }}"
                                            ><i class="bx bx-edit-alt me-1"></i>Edit</a>
                                            <form id="delete-role-form-id-{{ $role->id }}" method="POST" action="{{ route('role-destroy', ['id' => $role->id ]) }}">
                                                @csrf
                                                @method('delete')
                                                <button  type="submit" class="dropdown-item delete-role" data-id="{{ $role->id }}">
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
                <!--/ Role Table -->
            </div>
        </div>
@endsection

@section('page-script')
            <script>
                $('.delete-role').on('click', function (e) {
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
