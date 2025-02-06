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
          <div class="card-header"><h4 class="text-center font-weight-normal  my-1">Profile Edit</h4></div>          
          <div class="card-body">
            <form role="form" method="post" action="{{ route('user.profile.update') }}" enctype="multipart/form-data">
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
                  <input class="form-control" type="email" name="email" value="{{$user->email}}" placeholder="Email" >
                <span class="text-danger">{{ $errors->has('email') ? $errors->first('email'):''}}</span>
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
                    @if(!empty(Auth::user()->photo))
                    <img style="width:50px; height: 50px;border-radius: 50%;" title="{{Auth::user()->name}}" src="{{ asset('/profile/'.Auth::user()->photo)}}">
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
