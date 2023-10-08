@extends('layouts.main-base')
@section('content')
  <!-- Content wrapper -->
          <div class="content-wrapper">
          <div class="container-xxl flex-grow-1 container-p-y">
             <!-- Basic Layout -->
             <div class="row">
                <div class="col-xl">
                @if(Session::has('success'))
                        <div class="alert alert-success">
                            {{ Session::get('success') }}
                        </div>
                @endif
                <div class="card mb-4">
                <h5 class="card-header">Configurations</h5>
                         <form class="card-body" action="{{route('configuration-store')}}" method="post">
                        @csrf                        
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                            <label class="form-label" for="company-name">Company Name</label>
                            <input type="text" id="company-name" name="{{\App\Services\ConfigurationService::COMPANY_NAME}}" value="{{$configService->findByConfigKey('company_name')['configuration_value']}}" class="form-control" placeholder="Enter Company Name" />
                            </div>
                            <div class="col-md-6">
                            <label class="form-label" for="company-address">Company Address</label>
                            <div class="input-group input-group-merge">
                            <input type="text" id="company-address" name="{{\App\Services\ConfigurationService::COMPANY_ADDRESS}}" value="{{$configService->findByConfigKey('company_address')['configuration_value']}}" class="form-control" placeholder="Enter Company Address" />
                            </div>
                            </div>
                        </div>
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                            <label class="form-label" for="company-mobile">Company Mobile</label>
                            <input type="text" id="company-mobile" name="{{\App\Services\ConfigurationService::COMPANY_MOBILE}}" value="{{$configService->findByConfigKey('company_mobile')['configuration_value']}}" class="form-control" placeholder="Enter Company Mobile" />
                            </div>
                            <div class="col-md-6">
                            <label class="form-label" for="company-location">Company Location</label>
                                <div class="input-group input-group-merge">
                                    <select class="form-select company-location" name="{{\App\Services\ConfigurationService::COMPANY_LOCATION}}" id="company-location">
                                        <option value="">Select Country</option>
                                        @foreach($countryList as $country)
                                        <option value="{{$country->country_code}}" {{$configService->findByConfigKey('company_location')['configuration_value']==$country->country_code?'selected':''}}>{{$country->country_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                            <label class="form-label" for="company-logo">Company Logo</label>
                            <input type="file" id="company-logo" name="{{\App\Services\ConfigurationService::COMPANY_LOGO}}" class="form-control"/>
                            </div>
                            <div class="col-md-6">
                            <label class="form-label" for="base_url">Career Page Base URL</label>
                            <div class="input-group input-group-merge">
                                <input type="text" id="base_url" name="{{\App\Services\ConfigurationService::CAREER_BASE_PAGE_URL}}" value="{{$configService->findByConfigKey('career_base_page_url')['configuration_value']}}" class="form-control" placeholder="Career Page Base URL"/>
                            </div>
                            </div>
                        </div>
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                            <label class="form-label" for="notification-email">Notification Email</label>
                            <input type="email" id="notification-email" name="{{\App\Services\ConfigurationService::NOTIFICATION_EMAIL}}" value="{{$configService->findByConfigKey('notification_email')['configuration_value']}}" class="form-control" placeholder="Enter Notification Email" />
                            </div>
                            <div class="col-md-6 d-flex align-items-center">
                                @php
                                 $pulishedvalue = $configService->findByConfigKey('is_published_ln')['configuration_value'];
                                 if($pulishedvalue != true){
                                    $ispublished = '';
                                 }else{
                                    $ispublished = $pulishedvalue;
                                 }
                                @endphp
                               <div class="form-check">
                                <input type="checkbox" id="is_published_ln" class="form-check-input" name="{{\App\Services\ConfigurationService::IS_PUBLISHED_LN}}" value="{$configService->findByConfigKey('notification_email')['is_published_ln']}}" {{ $ispublished ?'checked':''}}>
                                <label class="form-check-label" for="is_published_ln">Is Job Published in Linked In</label>
                               </div> 
                            </div>
                        </div>
                        <div class="pt-4">
                            <button type="submit" class="btn btn-primary me-sm-3 me-1">Save Configurations</button>
                        </div>
                        </form>
                 </div>
                </div>
              </div>
             </div>
          </div>
          <!-- Content wrapper -->
@endsection

@section('page-script')
    <script>
      var $publishchkbox = $('#is_published_ln');
          $publishchkbox.on('change', function() {
             if($(this).is(':checked')){
                this.value = true;
             }else{
                this.value = '';
             }
                
       });
    </script>
@endsection

