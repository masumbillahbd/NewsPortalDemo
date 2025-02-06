
@extends('layouts.backend')
@section('title')
Admin
@endsection

@section('extra_css')

<style type="text/css">
  
</style>
@endsection

@section('extra_js')

@endsection

@section('content')
  <main>
  <div class="container-fluid">
    <div class="row justify-content-center">
      @include('back.parts.message')
      <div class="col-lg-6">
        <div class="card shadow-lg border-0 rounded-lg mt-4 mb-3">
          <div class="card-header"><h4 class="text-center font-weight-normal  my-1">User Edit </h4></div>          
          <div class="card-body">
            <form role="form" method="post" action="{{ route('user.update',['id'=>$user->id]) }}" enctype="multipart/form-data">
              @csrf
              <div class="form-group row">
                <label class="col-md-3" for="name">Name <span class="text-danger">*</span></label>
                <div class="col-md-9">
                  <input  class=" form-control" name="name" value="{{$user->name}}" placeholder="Name" type="text" autocomplete="off" required>
                  <span class="text-danger">{{ $errors->has('name') ? $errors->first('name'):''}}</span>
                </div>  
              </div>


              <div class="form-group row">
                <label class="col-md-3" for="email">Email <span class="text-danger">*</span></label>
                <div class="col-md-9">
                  <input class="form-control" type="email" name="email" value="{{$user->email}}" placeholder="Email" autocomplete="off">
                <span class="text-danger">{{ $errors->has('email') ? $errors->first('email'):''}}</span>
                </div>  
              </div>

              <div class="form-group row">
                <label class="col-md-3" for="role">Role <span class="text-danger">*</span></label>
                <div class="col-md-9">
                  <select class="form-control" name="role">
                    <option value="">--select user type--</option>
                    <option value="admin">Admin</option>
                    <option value="manager">Manager</option>
                    <option value="accountant">Accountant</option>
                  </select>
                <span class="text-danger">{{ $errors->has('role') ? $errors->first('role'):''}}</span>
                </div>  
              </div>

              <div class="form-group row">
                <label class="col-md-3" for="password">Password <span class="text-danger">*</span></label>
                <div class="col-md-9">
                  <input class="form-control" type="password" name="password" placeholder="Password" autocomplete="off">
                <span class="text-danger">{{ $errors->has('password') ? $errors->first('password'):''}}</span>
                </div>  
              </div>

              <div class="form-group row">
                <label class="col-md-3" for="password">Confirm Password <span class="text-danger">*</span></label>
                <div class="col-md-9">
                  <input class="form-control" type="password" name="confirm_password" placeholder="Confirm Password" autocomplete="off">
                <span class="text-danger">{{ $errors->has('password') ? $errors->first('password'):''}}</span>
                </div>  
              </div>

              <div class="form-group row">
                <label class="col-md-3" for="photo">Photo <small>(200x200)</small> <span class="text-danger"></span></label>
                <div class="col-md-9">
                  <div class="custom-file">
                    <input type="file" name="photo" class="custom-file-input" id="validatedCustomFile" >
                    <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                    <div class="invalid-feedback">Example invalid custom file feedback</div>
                  </div>
                  <span class="text-danger">{{ $errors->has('photo') ? $errors->first('photo'):''}}</span>
                </div>  
              </div>

              <button type="submit" class="float-right btn btn-primary">Save</button>
            </form>
          </div>
        </div>
      </div> <!--col-5-->
    </div>  
  </div>
</main>
@endsection
