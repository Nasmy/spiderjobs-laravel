<!DOCTYPE html>
<html
        lang="en"
        class="semi-style layout-navbar-fixed layout-menu-fixed"
        dir="ltr"
        data-theme="theme-semi-dark"
        data-assets-path="../../assets/"
        data-template="vertical-menu-template"
>
<head>
    <meta charset="utf-8" />
    <meta
            name="viewport"
            content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Apply - {{ $job->title }}</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../../assets/img/favicon/favicon.ico" />
    @include('layouts/sections/style')

</head>

<body>
<div class="layout-wrapper">
    <div class="layout-container">
        <div class="layout-page">
            <div class="content-wrapper container">
                <div class="container-xxl flex-grow-1 container-p-y">
                    @if(Session::has('success'))
                        <div class="alert alert-success">
                            {{ Session::get('success') }}
                        </div>
                    @endif
                    {!! $job->description !!}
                </div>

                @if(!Session::has('success'))
                <form method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="col-12 mb-4">
                        <label class="form-label" for="first-name">First Name</label>
                        <input
                            type="text"
                            id="first-name"
                            name="first_name"
                            class="form-control"
                            placeholder="Enter a first name"
                            value="{{ old('first_name') }}"
                        />
                        @error('first_name')
                        <strong class="text-danger">{{ $errors->first('first_name') }}</strong>
                        @enderror
                    </div>
                    <div class="col-12 mb-4">
                        <label class="form-label" for="last-name">Last Name</label>
                        <input
                            type="text"
                            id="last-name"
                            name="last_name"
                            class="form-control"
                            placeholder="Enter a last name"
                            value="{{ old('last_name') }}"
                        />
                        @error('last_name')
                        <strong class="text-danger">{{ $errors->first('last_name') }}</strong>
                        @enderror
                    </div>
                    <div class="col-12 mb-4">
                        <label class="form-label" for="mobile">Mobile</label>
                        <input
                            type="text"
                            id="mobile"
                            name="mobile"
                            class="form-control"
                            placeholder="Enter a mobile"
                            value="{{ old('mobile') }}"
                        />
                        @error('mobile')
                        <strong class="text-danger">{{ $errors->first('mobile') }}</strong>
                        @enderror
                    </div>
                    <div class="col-12 mb-4">
                        <label class="form-label" for="email">Email</label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            class="form-control"
                            placeholder="Enter a email"
                            value="{{ old('email') }}"
                        />
                        @error('email')
                        <strong class="text-danger">{{ $errors->first('email') }}</strong>
                        @enderror
                    </div>
                    <div class="col-12 mb-4">
                        <label class="form-label" for="cover-letter">Cover letter</label>
                        <textarea class="form-control" id="cover-letter" name="cover_letter">{{ old('cover_letter') }}</textarea>
                        @error('cover_letter')
                        <strong class="text-danger">{{ $errors->first('cover_letter') }}</strong>
                        @enderror
                    </div>
                    <div class="col-12 mb-4">
                        <label class="form-label" for="resume" accept=".pdf">Upload Resume</label>
                        <input
                            type="file"
                            id="resume"
                            name="resume"
                            class="form-control"
                        />
                        @error('resume')
                        <strong class="text-danger">{{ $errors->first('resume') }}</strong>
                        @enderror
                    </div>
                    <div class="col-12 my-5">
                        <button type="submit" class="btn btn-primary me-sm-3 me-1">Apply</button>
                    </div>
                </form>
                @endif
            </div>
        </div>
    </div>
</div>

@include('layouts/sections/script')
</body>
</html>
