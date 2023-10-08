@extends('layouts.main-base')
@section('title', 'Edit User - Apps')

@section('vendor-style')
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/select2/select2.css')}}" />
@endsection

@section('vendor-script')
    <script src="{{asset('assets/vendor/libs/select2/select2.js')}}"></script>
@endsection

@section('content')
    <div class="container-fluid flex-grow-1 container-p-y">
        <div class="row g-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('user-update', ['id' => $user->id])}}" class="row g-3" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="col-6 mb-4">
                                <label class="form-label" for="first-name">First Name</label>
                                <input
                                    type="text"
                                    id="first-name"
                                    name="first_name"
                                    class="form-control"
                                    placeholder="Enter a first name"
                                    value="{{ $user->first_name }}"
                                />
                                @error('first_name')
                                <strong style="color:red;">{{ $errors->first('first_name') }}</strong>
                                @enderror
                            </div>
                            <div class="col-6 mb-4">
                                <label class="form-label" for="last-name">Last Name</label>
                                <input
                                        type="text"
                                        id="last-name"
                                        name="last_name"
                                        class="form-control"
                                        placeholder="Enter a last name"
                                        value="{{ $user->last_name }}"
                                />
                                @error('last_name')
                                <strong style="color:red;">{{ $errors->first('last_name') }}</strong>
                                @enderror
                            </div>
                            <div class="col-6 mb-4">
                                <label class="form-label" for="role_id">Role</label>
                                <select class="form-control" id="role_id" name="role_id">
                                    <option disabled selected>Select a role</option>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}" @if($user->role_id == $role->id) selected @endif>{{ $role->name }}</option>
                                    @endforeach
                                </select>
                                @error('role_id')
                                <strong style="color:red;">{{ $errors->first('role_id') }}</strong>
                                @enderror
                            </div>
                            <div class="col-6 mb-4">
                                <label class="form-label" for="departments">Departments</label>
                                <select multiple class="multi-select form-control" id="departments" name="departments[]">
                                    @foreach($departments as $department)
                                        <option value="{{ $department->id }}" >{{ $department->name }}</option>
                                    @endforeach
                                </select>
                                @error('departments')
                                <strong style="color:red;">{{ $errors->first('departments') }}</strong>
                                @enderror
                            </div>
                            <div class="col-6 mb-4">
                                <label class="form-label" for="mobile">Mobile</label>
                                <input
                                        type="text"
                                        id="mobile"
                                        name="mobile"
                                        class="form-control"
                                        placeholder="Enter a mobile"
                                        value="{{ $user->mobile }}"
                                />
                                @error('mobile')
                                <strong style="color:red;">{{ $errors->first('mobile') }}</strong>
                                @enderror
                            </div>
                            <div class="col-6 mb-4">
                                <label class="form-label" for="mobile">Email</label>
                                <input
                                        type="email"
                                        id="email"
                                        name="email"
                                        class="form-control"
                                        placeholder="Enter a email"
                                        value="{{ $user->email }}"
                                />
                                @error('email')
                                <strong style="color:red;">{{ $errors->first('email') }}</strong>
                                @enderror
                            </div>
                            <div class="col-6 mb-4">
                                <label class="form-label" for="username">Username</label>
                                <input
                                        type="text"
                                        id="username"
                                        name="username"
                                        class="form-control"
                                        placeholder="Enter a username"
                                        value="{{ $user->username }}"
                                />
                                @error('username')
                                <strong style="color:red;">{{ $errors->first('username') }}</strong>
                                @enderror
                            </div>
                            <div class="col-6 mb-4">
                                <label class="form-label" for="password">Password</label>
                                <input
                                        type="password"
                                        id="password"
                                        name="password"
                                        class="form-control"
                                        placeholder="Enter a password"
                                />
                                @error('password')
                                <strong style="color:red;">{{ $errors->first('password') }}</strong>
                                @enderror
                            </div>
                            <div class="col-6 mb-4">
                                <label class="form-label" for="password_confirmation">Confirm password</label>
                                <input
                                        type="password"
                                        id="password_confirmation"
                                        name="password_confirmation"
                                        class="form-control"
                                        placeholder="Confirm password"
                                />
                                @error('password_confirmation')
                                <strong style="color:red;">{{ $errors->first('password_confirmation') }}</strong>
                                @enderror
                            </div>
                            <div class="col-6 mb-4">
                                <label class="form-label" for="city">City</label>
                                <input
                                        type="text"
                                        id="city"
                                        name="city"
                                        class="form-control"
                                        placeholder="Enter a city"
                                        value="{{ $user->city }}"
                                />
                                @error('city')
                                <strong style="color:red;">{{ $errors->first('city') }}</strong>
                                @enderror
                            </div>
                            <div class="col-6 mb-4">
                                <label class="form-label" for="zip">zip</label>
                                <input
                                        type="text"
                                        id="zip"
                                        name="zip"
                                        class="form-control"
                                        placeholder="Enter a zip"
                                        value="{{ $user->zip }}"
                                />
                                @error('zip')
                                <strong style="color:red;">{{ $errors->first('zip') }}</strong>
                                @enderror
                            </div>
                            <div class="col-6 mb-4">
                                <label class="form-label" for="address">address</label>
                                <input
                                        type="text"
                                        id="address"
                                        name="address"
                                        class="form-control"
                                        placeholder="Enter a address"
                                        value="{{ $user->address }}"
                                />
                                @error('address')
                                <strong style="color:red;">{{ $errors->first('address') }}</strong>
                                @enderror
                            </div>

                            <div class="col-12">
                                <button type="submit" class="btn btn-primary me-sm-3 me-1" id="userSubmit">Submit</button>
                                <button type="reset" class="btn btn-label-secondary">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--/ user Table -->
    </div>
    <!--/ user cards -->
@endsection

@section('page-script')
    <script>
        $(document).ready(function () {
            var departments = {!! json_encode($user->departments->pluck('id')->toArray()) !!};
            $(".multi-select").select2({
                'placeholder': 'select one or many'
            }).val(departments).trigger('change');
        });
    </script>
@endsection
ith
