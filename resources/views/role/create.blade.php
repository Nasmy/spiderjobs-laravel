@extends('layouts.main-base')
@section('title', 'Roles - Apps')
@section('vendor-style')
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/formvalidation/dist/css/formValidation.min.css')}}"/>
@endsection

@section('vendor-script')
    <script src="{{asset('assets/vendor/libs/datatables/jquery.dataTables.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/datatables-responsive/datatables.responsive.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.js')}}"></script>
@endsection

@section('content')
    <!-- Content -->

    <div class="container-fluid flex-grow-1 container-p-y">
        <div class="row g-4">
            <div class="col-12">
                <div class="card">
                    <h5 class="card-header">Role List</h5>
                    @if(Session::has('role-creation-fail'))
                        <div class="alert alert-danger">
                            {{ Session::get('role-creation-fail') }}
                        </div>
                    @endif
                    <div class="card-body">
                        <form action="{{route('role-store')}}" class="row g-3" method="post">
                            @csrf
                            <div class="col-12 mb-4">
                                <label class="form-label" for="modalRoleName">Role Name</label>
                                <input
                                    type="text"
                                    id="modalRoleName"
                                    name="name"
                                    class="form-control"
                                    placeholder="Enter a role name"
                                    tabindex="-1"
                                />
                                @error('name')
                                <strong style="color:red;">{{ $errors->first('name') }}</strong>
                                @enderror
                            </div>
                            <div class="col-12 mb-4">
                                <label class="form-label" for="modalRoleName">Description</label>
                                <input
                                    type="text"
                                    id="modalRoleName"
                                    name="description"
                                    class="form-control"
                                    placeholder="Enter a role description"
                                    tabindex="-1"
                                />
                                @error('description')
                                <strong style="color:red;">{{ $errors->first('description') }}</strong>
                                @enderror
                            </div>
                            <div class="col-12">
                                <h5>Role Permissions</h5>
                                @error('permissions')
                                <strong style="color:red;">{{ $errors->first('permissions') }}</strong>
                                @enderror
                                <!-- Permission table -->
                                <div class="table-responsive">
                                    <table class="table table-flush-spacing">
                                        <tbody>
                                        <tr>
                                            <td class="text-nowrap">
                                                Administrator Access
                                                <i
                                                    class="bx bx-info-circle bx-xs"
                                                    data-bs-toggle="tooltip"
                                                    data-bs-placement="top"
                                                    title="Allows a full access to the system"
                                                ></i>
                                            </td>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="selectAll"/>
                                                    <label class="form-check-label" for="selectAll"> Select All </label>
                                                </div>
                                            </td>
                                        </tr>
                                        @foreach($permissionList as $key => $value)
                                            <tr>
                                                <td class="text-nowrap">{{$permissionList[$key][0]->description}}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        @foreach($permissionList[$key] as $permission)
                                                            <div class="form-check me-3 me-lg-5">
                                                                <input class="form-check-input" type="checkbox"
                                                                       id="{{$permission->ident}}" name="permissions[]"
                                                                       value="{{$permission->id}}"/>
                                                                <label class="form-check-label" for="userManagementRead">
                                                                    {{$permission->child}} </label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <!-- Permission table -->
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary me-sm-3 me-1" id="roleSubmit">Submit</button>
                                <button
                                    type="reset"
                                    class="btn btn-label-secondary"
                                >
                                    Cancel
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Role Table -->
    </div>
    </div>
    <!--/ Role cards -->
@endsection


<script>
    <!--TODO need to add into separate file-->
    document.addEventListener('DOMContentLoaded', function (e) {
        (function () {
            // Select All checkbox click
            const selectAll = document.querySelector('#selectAll'),
                checkboxList = document.querySelectorAll('[type="checkbox"]');
            selectAll.addEventListener('change', t => {
                checkboxList.forEach(e => {
                    e.checked = t.target.checked;
                });
            });
        })();
    });
</script>
