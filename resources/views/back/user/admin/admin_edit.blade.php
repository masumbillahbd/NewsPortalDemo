
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
      <div class="col-lg-8">
        <div class="card shadow-lg border-0 rounded-lg mt-4 mb-3">
          <div class="card-header"><h4 class="text-center font-weight-normal  my-1">Edit User</h4></div>          
          <div class="card-body">
            <form role="form" method="post" action="{{ route('admin.update',['id'=>$admin->id]) }}" enctype="multipart/form-data">
              @csrf
              <div class="form-group row">
                <label class="col-md-3" for="name">Name <span class="text-danger">*</span></label>
                <div class="col-md-9">
                  <input  class=" form-control" name="name" value="{{$admin->name}}" placeholder="Name" type="text" autocomplete="off" required>
                  <span class="text-danger">{{ $errors->has('name') ? $errors->first('name'):''}}</span>
                </div>  
              </div>
              <div class="form-group row">
                <label class="col-md-3" for="short_name">Short Name <span class="text-danger"></span></label>
                <div class="col-md-9">
                  <input  class=" form-control" name="short_name" value="{{$admin->short_name}}" placeholder="Short Name" type="text" autocomplete="off">
                  <span class="text-danger">{{ $errors->has('short_name') ? $errors->first('short_name'):''}}</span>
                </div>  
              </div>

              <div class="form-group row">
                <label class="col-md-3" for="email">Email <span class="text-danger">*</span></label>
                <div class="col-md-9">
                  <input class="form-control" type="email" name="email" value="{{$admin->email}}" placeholder="Email" autocomplete="off">
                <span class="text-danger">{{ $errors->has('email') ? $errors->first('email'):''}}</span>
                </div>  
              </div>

              <div class="form-group row">
                <label class="col-md-3" for="role">Role <span class="text-danger">*</span></label>
                <div class="col-md-9">
                  <select class="form-control" name="role" required>
                      <option value="{{$admin->role}}">{{$admin->role}}</option>
                      <option value="admin">Super Admin</option>
                      <option value="manager admin">Manager Admin</option>
                      <option value="editor">Editor</option>
                      <option value="user">User</option>
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
                <label class="col-md-3" for="confirm_password">Confirm Password <span class="text-danger">*</span></label>
                <div class="col-md-9">
                  <input class="form-control" type="password" name="confirm_password" placeholder="Confirm Password" autocomplete="off">
                <span class="text-danger">{{ $errors->has('confirm_password') ? $errors->first('confirm_password'):''}}</span>
                </div>  
              </div>

              <div class="form-group row">
                <label class="col-md-3" for="photo">Photo <small>(200x200)</small> <span class="text-danger"></span></label>
                <div class="col-md-9">
                  <input type="file" name="photo" class="getInputFile" id="validatedCustomFile"  hidden/>
                  <label class="my_file-label" for="validatedCustomFile"><i class="fas fa-cloud-upload-alt"></i> Upload</label>
                  <span id="my-file-chosen"></span>
                  <br>
                  <label class="pt-1" id="profileLabel" for="photo">
                    @if(!empty($admin->photo))
                    <img style="width:50px; height: 50px;border-radius: 50%;" title="{{Auth::user()->name}}" src="{{ asset('/profile/'.$admin->photo)}}">
                    @else
                    <img style="width:50px; height: 50px;border-radius: 50%;" src="{{ asset('defaults/avatar01.png')}}">
                    @endif
                  </label>
                  <span class="text-danger">{{ $errors->has('photo') ? $errors->first('photo'):''}}</span>
                </div>  
              </div>

              <button type="submit" class="float-right btn btn-primary">Update</button>
            </form>
          </div>
        </div>
      </div> <!--col-5-->
    </div>  
  </div>
</main>
@endsection
