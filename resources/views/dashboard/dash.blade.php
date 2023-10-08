@extends('layouts.main-base')
@section('title', 'Dashboard - Analytics')

@section('vendor-style')
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/apex-charts/apex-charts.css')}}" />
@endsection

@section('vendor-script')
    <script src="{{asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>
@endsection

@section('page-script')
    <script src="{{asset('assets/js/dashboards-analytics.js')}}"></script>
@endsection
@section('content')
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <!-- Website Analytics-->
            <div class="col-lg-12 col-md-12">
                <!-- Growth Chart-->
                <div class="row">
                      <div class="col-4 mb-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <div class="d-flex align-items-center gap-3">
                                                <div class="avatar">
                                    <span class="avatar-initial bg-label-primary rounded-circle"
                                    ><i class="bx bx-user fs-4"></i
                                        ></span>
                                                </div>
                                                <div class="card-info">
                                                    <h5 class="card-title mb-0 me-2">{{ $jobsCount }}</h5>
                                                    <small class="text-muted">Total Jobs Posted</small>
                                                </div>
                                            </div>
                                         </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4 mb-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <div class="d-flex align-items-center gap-3">
                                                <div class="avatar">
                                    <span class="avatar-initial bg-label-warning rounded-circle"
                                    ><i class="menu-icon tf-icons bx bx-food-menu"></i
                                        ></span>
                                                </div>
                                                <div class="card-info">
                                                    <h5 class="card-title mb-0 me-2">{{$jobApplicationCount}}</h5>
                                                    <small class="text-muted">Total Applications received</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4 mb-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <div class="d-flex align-items-center gap-3">
                                                <div class="avatar">
                                    <span class="avatar-initial bg-label-primary rounded-circle"
                                    ><i class="bx bx-user fs-4"></i
                                        ></span>
                                                </div>
                                                <div class="card-info">
                                                    <h5 class="card-title mb-0 me-2">
                                                        @isset($latestJob->title)
                                                        {{ $latestJob->title }}
                                                        @endisset
                                                    </h5>
                                                    <small class="text-muted">Last Created Job</small>
                                                </div>
                                            </div>
                                         </div>
                                    </div>
                                </div>
                            </div>
                  </div>
            </div>
            <!-- Finance Summary -->
            <div class="col-lg-6 col-md-12 mb-4">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">Recent Five Jobs</h5>
                    </div>
                    <div class="card-body pb-2">
                    <div class="table-responsive text-nowrap">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>TITLE</th>
                                <th>EXPIRY DATE</th>
                                <th>CATEGORY</th>
                              </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                            @foreach($jobs as $job)
                                <tr>
                                    <td><a href="{{ route('job-show', ['id' => $job->id]) }}" rel="noopener">{{ $job->title }}</a></td>
                                    <td>{{ $job->expires_at }}</td>
                                    <td>{{ $job->category->name }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                   </div>
                </div>
            </div>
            <!-- Finance Summary -->
              <div class="col-lg-6 col-md-12 mb-4">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">Recent Five Applications</h5>
                    </div>
                    <div class="card-body pb-2">
                    <div class="table-responsive text-nowrap">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>APPLICANT NAME</th>
                                <th>MOBILE</th>
                                <th>EMAIL</th>
                                <th>RESUME</th>
                              </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                               @foreach($latestJobApplication as $application)
                                <tr>
                                    <td>{{$application->first_name}} {{$application->last_name}}</td>
                                    <td>{{$application->mobile}}</td>
                                    <td>{{$application->email}}</td>
                                    <td><a class="dropdown-item w-auto" href="{{ route('download-resume', ['jobApplicationId' => $application->id]) }}"
                                        ><i class="bx bx-download me-1"></i>Resume</a></td>
                                </tr>
                               @endforeach

                            </tbody>
                        </table>
                </div>



                     </div>
                </div>
            </div>
            <!-- Finance Summary -->
            <!--/ Activity Timeline -->
        </div>
    </div>
    <!-- / Content -->
@endsection
