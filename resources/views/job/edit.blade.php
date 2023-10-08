@extends('layouts.main-base')

@section('title', 'Edit Job - Apps')

@section('vendor-style')
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/flatpickr/flatpickr.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/quill/typography.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/quill/editor.css')}}" />
@endsection

@section('vendor-script')
    <script src="{{asset('assets/vendor/libs/flatpickr/flatpickr.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/quill/katex.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/quill/quill.js')}}"></script>
@endsection

@section('content')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <!-- Basic Layout -->
            <div class="row">
                <div class="col-xl">
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Edit Job</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('job-update', ['id' => $job->id]) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label class="form-label" for="job-title">Job Title</label>
                                    <input type="text" class="form-control" id="job-title" placeholder="Job Title" name="title" value="{{ $job->title }}"/>
                                    @error('title')
                                    <strong class="text-danger">{{ $errors->first('title') }}</strong>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Job Description</label>
                                    <textarea id="job-description" type="hidden" class="d-none" name="description">{!! $job->description !!}</textarea>
                                    <div id="snow-toolbar">
                                          <span class="ql-formats">
                                            <select class="ql-font"></select>
                                            <select class="ql-size"></select>
                                          </span>
                                        <span class="ql-formats">
                                            <button class="ql-bold"></button>
                                            <button class="ql-italic"></button>
                                            <button class="ql-underline"></button>
                                            <button class="ql-strike"></button>
                                          </span>
                                        <span class="ql-formats">
                                            <select class="ql-color"></select>
                                            <select class="ql-background"></select>
                                          </span>
                                        <span class="ql-formats">
                                            <button class="ql-script" value="sub"></button>
                                            <button class="ql-script" value="super"></button>
                                          </span>
                                        <span class="ql-formats">
                                            <button class="ql-header" value="1"></button>
                                            <button class="ql-header" value="2"></button>
                                            <button class="ql-blockquote"></button>
                                            <button class="ql-code-block"></button>
                                        </span>
                                    </div>
                                    <div id="snow-editor">{!! $job->description !!}</div>
                                    @error('description')
                                    <strong class="text-danger">{{ $errors->first('description') }}</strong>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="job-apply-url">Job Apply URL</label>
                                    <input type="text" class="form-control" id="job-apply-url" placeholder="Job Apply URL" name="job_apply_url" value="{{ $job->job_apply_url }}"/>
                                    @error('job_apply_url')
                                    <strong class="text-danger">{{ $errors->first('job_apply_url') }}</strong>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="job-category">Job Category</label>
                                    <select name="job_category_id" id="job-cat" class="form-control">
                                        <option value="" selected disbaled>Select Category</option>
                                        @foreach($jobCategories as $jobCategory)
                                            <option value="{{ $jobCategory->id }}" {{ $job->category->id === $jobCategory->id ? 'selected' : '' }}>
                                                {{ $jobCategory->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('job_category_id')
                                    <strong class="text-danger">{{ $errors->first('job_category_id') }}</strong>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="department_id">Department</label>
                                    <select name="department_id" id="department_id" class="form-control">
                                        <option value="" selected disbaled>Select Department</option>
                                        @foreach($departments as $department)
                                            <option value="{{ $department->id }}" {{ $job->department->id === $department->id ? 'selected' : '' }}>
                                                {{ $department->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('department_id')
                                    <strong class="text-danger">{{ $errors->first('department_id') }}</strong>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="country-code">Country</label>
                                    <select name="country" id="country-code" class="countryselect form-select" data-allow-clear="true">
                                        <option value="">Select</option>
                                        @foreach($countries as $country)
                                        <option value="{{ $country->country_name }}" {{ $job->country == $country->country_name ? 'selected' : '' }}>
                                            {{ $country->country_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('country')
                                    <strong class="text-danger">{{ $errors->first('country') }}</strong>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="job-category">Work Place Type</label>
                                    <select name="work_place_type" id="workplace-type" class="form-control">
                                        <option value="" selected disbaled>Select </option>
                                        @foreach(\App\WorkPlace::toArray() as $key => $value)
                                            <option value="{{ $key }}" {{ $job->work_place_type === $key ? 'selected' : ''}}>
                                                {{ $value }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('work_place_type')
                                    <strong class="text-danger">{{ $errors->first('work_place_type') }}</strong>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="employment-status">Employment Type</label>
                                    <select name="emp_type_id" id="employment-status" class="form-control">
                                        <option value="" selected disbaled>Select</option>
                                        @foreach($employmentTypes as $employmentType)
                                            <option value="{{ $employmentType->id }}" {{ $job->employmentType->id === $employmentType->id ? 'selected' : '' }}>
                                                {{ $employmentType->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('emp_type_id')
                                    <strong class="text-danger">{{ $errors->first('emp_type_id') }}</strong>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="experience-level">Experience Level</label>
                                    <select name="experience_level_id" id="experience-level" class="form-control">
                                        <option value="" selected disbaled>Select</option>
                                        @foreach($experienceLevels as $experienceLevel)
                                            <option value="{{ $experienceLevel->id }}" {{ $job->experienceLevel->id === $experienceLevel->id ? 'selected' : ''}}>
                                                {{ $experienceLevel->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('experience_level_id')
                                    <strong class="text-danger">{{ $errors->first('experience_level_id') }}</strong>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="job-expiry">Job Expiration Date</label>
                                    <input type="text" id="job-expiry" class="form-control dob-picker" placeholder="YYYY-MM-DD" name="expiration_at" value="{{ $job->expiration_at }}"/>
                                    @error('expiration_at')
                                    <strong class="text-danger">{{ $errors->first('expiration_at') }}</strong>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="jobstatus">Job Status</label>
                                    <select name="status" id="jobstatus" class="form-control">
                                        <option value="" selected disbaled>Select</option>
                                        <option value="1" {{ $job->status == '1' ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ $job->status == '0' ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                    @error('status')
                                    <strong class="text-danger">{{ $errors->first('status') }}</strong>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Content wrapper -->
@endsection

@section('page-script')
    <script>
        $(document).ready(function () {
            var flatpickrDate = document.querySelector("#job-expiry");

            flatpickrDate.flatpickr({
                monthSelectorType: "static",
                minDate: "today",
            });

            var jobDescription = new Quill('#snow-editor', {
                bounds: '#snow-editor',
                modules: {
                    formula: true,
                    toolbar: '#snow-toolbar'
                },
                theme: 'snow'
            });

            var oldDescription = "{!! old('description') !!}";
            if(oldDescription) {
                jobDescription.root.innerHTML = oldDescription;
                $('#job-description').val(oldDescription);
            }
            jobDescription.on('text-change', function(delta, oldDelta, source) {
                $('#job-description').val(jobDescription.root.innerHTML);
            });
        });
    </script>
@endsection