@extends('layouts.main-base')
@section('content')
  <!-- Content wrapper -->
          <div class="content-wrapper">
          <div class="container-xxl flex-grow-1 container-p-y">
             <!-- Basic Layout -->
             <div class="row">
                <div class="col-xl">
                  <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                      <h5 class="mb-0">Edit Job Category</h5>
                      <small class="text-muted float-end">Default label</small>
                    </div>
                    <div class="card-body">
                          @if(Session::has('jobcat-creation-fail'))
                              <div class="alert alert-danger">
                                  {{ Session::get('jobcat-creation-fail') }}
                              </div>
                          @endif
                      <form action="{{route('job-category-update', ['id' => $jobCat->id])}}" method="POST">
                      @csrf
                      @method('PUT')
                        <div class="mb-3">
                          <label class="form-label" for="job-cat-title">Job Category Name</label>
                          <input type="text" class="form-control" id="job-cat-title" value="{{ $jobCat->name }}" name="name" placeholder="Job Category Name" />
                          @error('name')
                            <strong style="color:red;">{{ $errors->first('name') }}</strong>
                          @enderror
                        </div>
                        <div class="mb-3">
                          <label class="form-label" for="job-cat-description">Job Category Description</label>
                          <textarea class="form-control" id="job-cat-description" name="description" placeholder="Job Category Description" >{{ $jobCat->description }}</textarea>
                          @error('description')
                            <strong style="color:red;">{{ $errors->first('description') }}</strong>
                          @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Add</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
             </div>
          </div>
          <!-- Content wrapper -->
@endsection
