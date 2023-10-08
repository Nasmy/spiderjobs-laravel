@extends('layouts.job-open')

@section('title', 'Jobs - Open')

@section('vendor-style')
  <link rel="stylesheet" href="{{asset('assets/vendor/libs/sweetalert2/sweetalert2.css')}}"/>
@endsection

@section('vendor-script')
  <script src="{{asset('assets/vendor/libs/sweetalert2/sweetalert2.js')}}"></script>
@endsection

@section('content')
<div class="content-wrapper">
   <!-- Content -->
   <!-- Job Listings -->
   <div class="help-center-knowledge-base help-center-bg-alt pt-5 pb-4">
                  <div class="container-xl py-2">
                    <h4 class="text-center pb-4 mb-4">Current Openings</h4>
                    <div class="row">
                      <div class="col-lg-10 mx-auto">
                        <div class="row">
                        @foreach($jobs as $job)
                          <div class="col-md-4 col-sm-6 mb-4">
                            <div class="card">
                              <div class="card-body">
                                <span class="opening-date">{{$job->created_at->format('Y-m-d')}}</span>
                                <h5 class="mt-3 mb-2">{{ $job->title }}<span>/{{ $job->work_place_type }}</san></h5>
                                <p>{{ $job->category->name }}</p>
                                <div class="job-excerpt mb-4">{!! Str::limit($job->description, 100, $end='...') !!} </div>
                                <p class="mb-0 fw-semibold d-inline-block left btn btn-label-secondary">
                                  <a data-bs-toggle="modal" href="#" data-bs-target="#job{{$job->id}}">View More</a>
                                </p>
                                <p class="mb-0 fw-semibold d-inline-block float-xxl-end btn btn-label-secondary">
                                  <a href="{{ route('job-apply-form', ['applyUrl' => $job->job_apply_url])  }}">Apply Now</a>
                                </p>
                              </div>
                            </div>
                          </div>
                          @endforeach
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
             @foreach($jobs as $job)
             <!-- Job Modal -->
              <div class="modal fade" id="job{{$job->id}}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-simple modal-enable-otp modal-dialog-centered">
                  <div class="modal-content p-3 p-md-5">
                    <div class="modal-body">
                      <p class="closing-date mb-3">Closing Date: {{date('Y-m-d', strtotime($job->expiration_at))}}</p>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      <div class="text-center mb-4">
                        <h3 class="mb-5">{{ $job->title }}<span>/{{ $job->work_place_type }}</h3>
                      </div>
                      <div class="job-info">
                        <h6 class="mb-3">Job Category : {{ $job->category->name }}</h6>
                        <h6 class="mb-3">Experience Level : {{ $job->experienceLevel->name }}</h6>
                        <h6 class="mb-3">Employment Type : {{ $job->employmentType->name }}</h6>
                        <h6 class="mb-4">Country : {{ $job->country }}</h6>
                      </div>
                      <div class="job-description">{!! $job->description !!}</div>
                    </div>
                  </div>
                </div>
              </div>
            <!--/ Job Modal -->
          @endforeach
      <!-- /Joblistings-->
</div>
@endsection


@section('page-script')
    <script>
        $(document).ready(function () {
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
