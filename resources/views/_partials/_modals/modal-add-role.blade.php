<!-- Add Role Modal -->
<div class="modal fade" id="addRoleModal" tabindex="-1" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-add-new-role">
        <div class="modal-content p-3 p-md-5">
            <button
                type="button"
                class="btn-close btn-pinned"
                data-bs-dismiss="modal"
                aria-label="Close"
            ></button>
            <div class="modal-body">
                <div class="text-center mb-4">
                    <h3 class="role-title">Add New Role</h3>
                    <p>Set role permissions</p>
                </div>
                <!-- Add role form -->
                <form action="{{route('role-create')}}"  class="row g-3" method="post">
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
                        <strong style="color:red;">{{ $errors->first('description') }}</strong>
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
                                                               id="{{$permission->ident}}" name="permissions[]" value="{{$permission->child}}"/>
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
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary me-sm-3 me-1" id="roleSubmit">Submit</button>
                        <button
                            type="reset"
                            class="btn btn-label-secondary"
                            data-bs-dismiss="modal"
                            aria-label="Close"
                        >
                            Cancel
                        </button>
                    </div>
                </form>
                <!--/ Add role form -->
            </div>
        </div>
    </div>
</div>
