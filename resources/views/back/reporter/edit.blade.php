@extends('layouts.backend')
@section('title')
    Admin
@endsection

@section('extra_css')

@endsection

@section('extra_js')
<script>
    $(document).ready(function () {
        document.getElementById("position").addEventListener("keyup", function() {
          this.value = this.value.replace(/[^0-9]/g,"");
        });
    })
</script>
@endsection

@section('content')
    <main>
        <div class="container-fluid">
            <div class="row justify-content-center">
                @include('back.parts.message')
                <div class="col-lg-8">
                    <div class="card shadow-lg border-0 rounded-lg mt-4 mb-3">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="font-weight-normal  my-1">
                                        Edit Reporter
                                    </h4>
                                </div>
                                <div class="col-md-6">
                                    <a href="{{ route('reporter.index') }}" class="btn btn-primary float-right">Reporter List</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form role="form" method="post" action="{{ route('reporter.update',['id'=>$reporter->id]) }}"
                                  enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-md-3" for="name">Name <span
                                                class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <input class=" form-control" name="name" value="{{$reporter->name}}" placeholder="Name" type="text"
                                               autocomplete="off" required>
                                        <span class="text-danger">{{ $errors->has('name') ? $errors->first('name'):''}}</span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3" for="designation">Designation <span
                                                class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <input class="form-control" type="text" name="designation" value="{{$reporter->designation}}" placeholder="Designation"
                                               autocomplete="off" required>
                                        <span class="text-danger">{{ $errors->has('designation') ? $errors->first('designation'):''}}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3" for="position">position</label>
                                    <div class="col-md-9">
                                        <input class="form-control" id="position" type="text" name="position" value="{{$reporter->position}}" placeholder="Position"
                                               autocomplete="off" required>
                                        <span class="text-danger">{{ $errors->has('position') ? $errors->first('position'):''}}</span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3" for="photo">Photo <small>(300x300)</small> <span
                                                class="text-danger"></span></label>
                                    <div class="col-md-9">
                                        <input type="file" name="photo" class="getInputFile"
                                               id="validatedCustomFile"
                                               hidden/>
                                        <label class="my_file-label" for="validatedCustomFile"><i
                                                    class="fas fa-cloud-upload-alt"></i> Upload</label>
                                        <span id="my-file-chosen"></span>
                                        <span class="text-danger">{{ $errors->has('photo') ? $errors->first('photo'):''}}</span>
                                        @if(!empty($reporter->photo)) <img src="{{asset('reporter/'.$reporter->photo)}}"> @endif
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
