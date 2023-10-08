@inject('authService', 'App\Services\AuthService')
@php
    $role_id = \Illuminate\Support\Facades\Auth::user()->role_id;
@endphp
@extends('layouts.main-base')
@section('title', 'Users - Apps')
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
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 breadcrumb-wrapper mb-2">Users List</h4>
        @if(Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        @endif

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
                                <a href="{{route('user-create')}}"
                                   class="btn btn-primary mb-3 text-nowrap"
                                >
                                    Add New User
                                </a>
                                <p class="mb-0">Add user, if it does not exist</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <h5 class="card-header">Users List</h5>
                    <div class="table-responsive text-nowrap">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Username</th>
                                <th>Role</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                            @foreach ($userList as $user)
                                <tr>
                                    <td><strong>{{$user->first_name}}</strong></td>
                                    <td><strong>{{$user->last_name}}</strong></td>
                                    <td><strong>{{$user->username}}</strong></td>
                                    <td><strong>{{$user->role->name}}</strong></td>
                                    <td>
                                        <div class="d-flex">
                                            <a class="dropdown-item w-auto" href="{{ route('user-edit', ['id' => $user->id]) }}"
                                            ><i class="bx bx-edit-alt me-1"></i>Edit</a>
                                            <form id="delete-user-form-id-{{ $user->id }}" method="POST" action="{{ route('user-destroy', ['id' => $user->id ]) }}">
                                                @csrf
                                                @method('delete')
                                                <button  type="submit" class="dropdown-item delete-user" data-id="{{ $user->id }}">
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
            </div>
        </div>
        @endsection

        @section('page-script')
        <script>
            $('.delete-user').on('click', function (e) {
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
