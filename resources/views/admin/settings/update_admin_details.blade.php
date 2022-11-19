@extends('admin.layout.layout')
@section('content')
<div class="main-panel">        
    <div class="content-wrapper">
      <div class="row">
        <div class="col-12 col-xl-8 mb-4 mb-xl-0">
            <h3 class="font-weight-bold">Settings</h3>
            
          </div>
        <div class="col-md-6 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Update Admin Password</h4>
              @if ($errors->any())                 
                  <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
              @endif
              @if(Session::has('error_message'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">          
                  <strong>Error:</strong> {{ Session::get('error_message') }}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
              @endif
              @if(Session::has('success_message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">          
                  <strong>Error:</strong> {{ Session::get('success_message') }}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
              @endif
              <form class="forms-sample" action="{{ url('admin/update-admin-details') }}" method="POST">
                @csrf
                <div class="form-group">
                  <label >Admin Username/ Email</label>
                  <input class="form-control" placeholder="Username" value="{{ $admindetails['email'] }}" readonly="">
                </div>
                <div class="form-group">
                  <label >Admin Type</label>
                  <input class="form-control"  placeholder="Email" value="{{ $admindetails['type'] }}" readonly="">
                </div>
                <div class="form-group">
                  <label for="name" >Name</label>
                  <input name="name" type="text" id="name" class="form-control"  placeholder="Enter your name " value="{{ $admindetails->name }}" >
                  <span id="check_password"></span>
                </div>
                <div class="form-group">
                  <label for="mobile">Mobile</label>
                  <input name="mobile" type="text" id="mobile" class="form-control"  placeholder="Enter 10-digit mobile number" required="" value="{{ $admindetails->mobile }}" maxlength="10" minlength="10" >
                </div>
                {{-- <div class="form-group">
                  <label for="Image">Image</label>
                  <input name="Image" type="text" class="form-control" id="Image" placeholder=" Image" required="" >
                  
                </div> --}}
                {{-- <div class="form-check form-check-flat form-check-primary">
                  <label class="form-check-label">
                    <input type="checkbox" class="form-check-input">
                    Remember me
                  </label>
                </div> --}}
                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                <button class="btn btn-light">Cancel</button>
              </form>
            </div>
          </div>
        </div>
        
      </div>
    </div>
    <!-- content-wrapper ends -->
    <!-- partial:../../partials/_footer.html -->
    <footer class="footer">
      <div class="d-sm-flex justify-content-center justify-content-sm-between">
        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2021.  Premium <a href="https://www.bootstrapdash.com/" target="_blank">Bootstrap admin template</a> from BootstrapDash. All rights reserved.</span>
        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="ti-heart text-danger ml-1"></i></span>
      </div>
    </footer>
    <!-- partial -->
  </div>

@stop