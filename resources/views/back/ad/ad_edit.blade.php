@extends('layouts.backend')
@section('title')
    Admin | Advertise Setup
@endsection

@section('extra_css')
    <style type="text/css">
        .richIMG img {
            width: 100%;
        }
        .ads__img{
            height: 100px;
            max-width: 250px;
        }
    </style>
@endsection

@section('extra_js')
  
@endsection

@section('content')
    <main>
        <div class="container-fluid">
            <div class="row justify-content-center">
                @include('back.parts.message')
                <div class="col-lg-4">
                    <div class="card shadow-lg border-0 rounded-lg mt-4 mb-3">
                        <div class="card-header"><h4 class="text-center font-weight-light my-1">Edit Advertisement</h4>
                        </div>
                        <div class="card-body">
                            <form role="form" method="post" action="{{ route('ad.update',['id'=>$ad->id]) }}"
                                  enctype="multipart/form-data">
                                @csrf

                                <div class="form-group row">
                                    <label class="col-md-3" for="name">Name <span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <input class=" form-control" name="name" value="{{$ad->name}}"
                                               placeholder="Name" type="text" autocomplete="off" required>
                                        <span class="text-danger">{{ $errors->has('name') ? $errors->first('name'):''}}</span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3" for="url">URL <span class="text-danger"></span></label>
                                    <div class="col-md-9">
                                        <input class=" form-control" name="url" value="{{$ad->url}}" placeholder="URL"
                                               type="text">
                                        <span class="text-danger">{{ $errors->has('url') ? $errors->first('url'):''}}</span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3" for="position">Position <span
                                                class="text-danger"></span></label>
                                    <div class="col-md-9">
                                        <input class=" form-control" name="position" value="{{$ad->position}}"
                                               placeholder="Position" type="number">
                                        <span class="text-danger">{{ $errors->has('position') ? $errors->first('position'):''}}</span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3" for="photo">Photo<span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <input type="file" name="photo" class="getInputFile" id="validatedCustomFile"
                                               hidden/>
                                        <label class="my_file-label" for="validatedCustomFile"><i
                                                    class="fas fa-cloud-upload-alt"></i> Upload</label>
                                        <span id="my-file-chosen"></span>
                                        <br>
                                        <label class="pt-1" id="profileLabel" for="photo">
                                        </label>
                                        <span class="text-danger">{{ $errors->has('photo') ? $errors->first('photo'):''}}</span>
                                    </div>
                                </div>

                                <button type="submit" class="float-right btn btn-success">Update</button>
                            </form>
                        </div>
                    </div>
                </div> <!--col-6-->

                <div class="col-lg-8">
                    <div class="card shadow-lg border-0 rounded-lg mt-3 mb-3">
                        <div class="card-header">
                            <h4 class="text-center font-weight-light my-1">All Advertisement</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th class="text-center" style="width: 50px;">ID</th>
                                        <th>Name</th>
                                        <th>URL</th>
                                        <th class="text-center">Position</th>
                                        <th class="text-center">Photo</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach(\App\Models\Ad::orderBy('position','asc')->get() as $row)
                                        <tr>
                                            <td class="text-center">{{$row->id}}</td>
                                            <td>{{$row->name}}</td>
                                            <td>{{$row->url}}</td>
                                            <td class="text-center">{{$row->position}}</td>
                                            <td class="text-center"><img src="{{ asset('/ads/'.$row->photo) }}" class="ads__img"></td>
                                            <td class="text-center">
                                                <a href="{{ route('ad.edit', ['id' => $row->id])}}"
                                                   class="btn btn-soft-primary btn-icon btn-circle btn-sm"><i
                                                            class="fa fa-edit"></i></a>
                                                <a href="{{ route('ad.delete', ['id' => $row->id])}}"
                                                   onclick="return confirm('Are you sure to delete this!')"
                                                   class="btn btn-soft-danger btn-icon btn-circle btn-sm"><i
                                                            class="fa fa-trash"></i> </a>
                                            </td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div> <!--col-6-->

            </div>
        </div>
    </main>
@endsection
