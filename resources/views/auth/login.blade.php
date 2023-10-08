@extends('layouts.login-base')
@section('content')

    <!-- Register -->
    <div class="card">
        <div class="card-body">
            <!-- Logo -->
            <div class="app-brand justify-content-center">
                <a href="index.html" class="app-brand-link gap-2">
                  <span class="app-brand-logo demo">
                  <svg width="62" height="99" viewBox="0 0 62 99" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M5.9107 98.0909H1.34961V75.5165L28.4731 75.501V98.0909H23.8209V79.9912L5.9107 80.0557V98.0909Z" fill="#3B9E9E"/>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M27.7196 70.23H23.0411V60.8012L0.596191 60.7192V37.8817L5.12426 37.861L5.2281 56.0868H23.0411L23.2104 37.8511H27.7196V70.23Z" fill="#3B9E9E"/>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M34.5005 9.23706H61.6239V22.6745H48.0618V18.5369H56.9361V14.0581H39.1883V27.4955L61.6239 27.7155V32.58H34.5005V9.23706Z" fill="#3B9E9E"/>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M5.13067 0.954102L0.612547 0.965565V14.6218L23.1001 14.6586L23.0535 27.8137H0.596191V32.58H27.7196L27.655 9.93897H5.1781L5.13067 0.954102Z" fill="#3B9E9E"/>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M34.6023 75.5125L34.5005 98.0908H61.6239V93.6317L38.8761 93.4686L38.9205 80.0921L61.6239 80.0487V66.5066L57.0964 66.4648L57.075 75.533L34.6023 75.5125Z" fill="#3B9E9E"/>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M56.8752 56.7992L39.047 56.659L39.0813 43.4576H56.8752V56.7992ZM34.5005 38.604V61.0856L61.6239 61.194V38.7116L34.5005 38.604Z" fill="#FED600"/>
                    </svg>
                  </span>
                    <span class="app-brand-text demo h3 mb-0 fw-bold">Job Portal</span>
                </a>
            </div>
            <!-- /Logo -->
            <h4 class="mb-2">Welcome to Job Portal! 👋</h4>
            <p class="mb-4">Please sign-in to your account and start the adventure</p>

            @if(Session::has('login-invalid-message'))
                <div class="alert alert-danger">
                    {{ Session::get('login-invalid-message') }}
                </div>
            @endif
            <form id="formAuthentication" class="mb-3" action="{{route('authenticate')}}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email or Username</label>
                    <input
                        type="text"
                        class="form-control"
                        id="email"
                        name="username"
                        placeholder="Enter your email or username"
                        autofocus
                    />
                    @error('username')
                    <strong style="color:red;">{{ $errors->first('username') }}</strong>
                    @enderror
                </div>
                <div class="mb-3 form-password-toggle">
                    <div class="d-flex justify-content-between">
                        <label class="form-label" for="password">Password</label>
                    </div>
                    <div class="input-group input-group-merge">
                        <input
                            type="password"
                            id="password"
                            class="form-control"
                            name="password"
                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                            aria-describedby="password"
                        />
                        <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                    </div>
                    @error('password')
                    <strong style="color:red;">{{ $errors->first('password') }}</strong>
                    @enderror
                </div>
                <div class="mb-3">
                    <input type="hidden" name="login_method" value="tenant">
                </div>
                <button class="btn btn-primary d-grid w-100">Login</button>
            </form>
        </div>
    </div>
       {{-- <!-- Login -->
        <div class="d-flex col-12 col-lg-5 col-xl-4 align-items-center authentication-bg p-sm-5 p-4">
            <div class="w-px-400 mx-auto">
                <!-- Logo -->
                <div class="app-brand mb-4">
                    <a href="index.html" class="app-brand-link gap-2 mb-2">
                <span class="app-brand-logo demo">
                  <svg
                      width="26px"
                      height="26px"
                      viewBox="0 0 26 26"
                      version="1.1"
                      xmlns="http://www.w3.org/2000/svg"
                      xmlns:xlink="http://www.w3.org/1999/xlink"
                  >
                    <title>icon</title>
                    <defs>
                      <linearGradient x1="50%" y1="0%" x2="50%" y2="100%" id="linearGradient-1">
                        <stop stop-color="#5A8DEE" offset="0%"></stop>
                        <stop stop-color="#699AF9" offset="100%"></stop>
                      </linearGradient>
                      <linearGradient x1="0%" y1="0%" x2="100%" y2="100%" id="linearGradient-2">
                        <stop stop-color="#FDAC41" offset="0%"></stop>
                        <stop stop-color="#E38100" offset="100%"></stop>
                      </linearGradient>
                    </defs>
                    <g id="Pages" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                      <g id="Login---V2" transform="translate(-667.000000, -290.000000)">
                        <g id="Login" transform="translate(519.000000, 244.000000)">
                          <g id="Logo" transform="translate(148.000000, 42.000000)">
                            <g id="icon" transform="translate(0.000000, 4.000000)">
                              <path
                                  d="M13.8863636,4.72727273 C18.9447899,4.72727273 23.0454545,8.82793741 23.0454545,13.8863636 C23.0454545,18.9447899 18.9447899,23.0454545 13.8863636,23.0454545 C8.82793741,23.0454545 4.72727273,18.9447899 4.72727273,13.8863636 C4.72727273,13.5423509 4.74623858,13.2027679 4.78318172,12.8686032 L8.54810407,12.8689442 C8.48567157,13.19852 8.45300462,13.5386269 8.45300462,13.8863636 C8.45300462,16.887125 10.8856023,19.3197227 13.8863636,19.3197227 C16.887125,19.3197227 19.3197227,16.887125 19.3197227,13.8863636 C19.3197227,10.8856023 16.887125,8.45300462 13.8863636,8.45300462 C13.5386269,8.45300462 13.19852,8.48567157 12.8689442,8.54810407 L12.8686032,4.78318172 C13.2027679,4.74623858 13.5423509,4.72727273 13.8863636,4.72727273 Z"
                                  id="Combined-Shape"
                                  fill="#4880EA"
                              ></path>
                              <path
                                  d="M13.5909091,1.77272727 C20.4442608,1.77272727 26,7.19618701 26,13.8863636 C26,20.5765403 20.4442608,26 13.5909091,26 C6.73755742,26 1.18181818,20.5765403 1.18181818,13.8863636 C1.18181818,13.540626 1.19665566,13.1982714 1.22574292,12.8598734 L6.30410592,12.859962 C6.25499466,13.1951893 6.22958398,13.5378796 6.22958398,13.8863636 C6.22958398,17.8551125 9.52536149,21.0724191 13.5909091,21.0724191 C17.6564567,21.0724191 20.9522342,17.8551125 20.9522342,13.8863636 C20.9522342,9.91761479 17.6564567,6.70030817 13.5909091,6.70030817 C13.2336969,6.70030817 12.8824272,6.72514561 12.5388136,6.77314791 L12.5392575,1.81561642 C12.8859498,1.78721495 13.2366963,1.77272727 13.5909091,1.77272727 Z"
                                  id="Combined-Shape2"
                                  fill="url(#linearGradient-1)"
                              ></path>
                              <rect
                                  id="Rectangle"
                                  fill="url(#linearGradient-2)"
                                  x="0"
                                  y="0"
                                  width="7.68181818"
                                  height="7.68181818"
                              ></rect>
                            </g>
                          </g>
                        </g>
                      </g>
                    </g>
                  </svg>
                </span>
                        <span class="app-brand-text demo h3 mb-0 fw-bold">Frest</span>
                    </a>
                </div>
                <!-- /Logo -->
                <h4 class="mb-2">Welcome to Frest! 👋</h4>
                <p class="mb-4">Please sign-in to your account and start the adventure</p>
                @if(Session::has('login-invalid-message'))
                    <div class="alert alert-danger">
                        {{ Session::get('login-invalid-message') }}
                    </div>
                @endif
                <form id="formAuthentication" class="mb-3" action="{{route('authenticate')}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Email or Username</label>
                        <input
                            type="text"
                            class="form-control"
                            id="email"
                            name="username"
                            placeholder="Enter your email or username"
                            autofocus
                        />
                        @error('username')
                        <strong style="color:red;">{{ $errors->first('username') }}</strong>
                        @enderror
                    </div>
                    <div class="mb-3 form-password-toggle">
                        <div class="d-flex justify-content-between">
                            <label class="form-label" for="password">Password</label>
                        </div>
                        <div class="input-group input-group-merge">
                            <input
                                type="password"
                                id="password"
                                class="form-control"
                                name="password"
                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                aria-describedby="password"
                            />
                            <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                        </div>
                        @error('password')
                        <strong style="color:red;">{{ $errors->first('password') }}</strong>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <input type="hidden" name="login_method" value="tenant">
                    </div>
                    <button class="btn btn-primary d-grid w-100">Login</button>
                </form>
            </div>
        </div>--}}
@endsection
