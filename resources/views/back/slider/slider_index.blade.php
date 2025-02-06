@extends('layouts.backend')
@section('title')
    Admin | Index
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
                        <div class="card-header"><h4 class="font-weight-light my-1">Add Slider</h4></div>
                        <div class="card-body">
                            <form role="form" method="post" action="{{ route('slider.store') }}"
                                  enctype="multipart/form-data">
                                @csrf

                                <div class="form-group row">
                                    <label class="col-md-3" for="title">Title <span class="text-danger"></span></label>
                                    <div class="col-md-9">
                                        <input class="form-control" name="title" placeholder="Title" type="text"
                                               autocomplete="off">
                                        <span class="text-danger">{{ $errors->has('title') ? $errors->first('title'):''}}</span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3" for="link">Link <span class="text-danger"></span></label>
                                    <div class="col-md-9">
                                        <input class="form-control" name="link" placeholder="Link" type="text"
                                               autocomplete="off">
                                        <span class="text-danger">{{ $errors->has('link') ? $errors->first('link'):''}}</span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3" for="image">Image<small>(982x500)</small><span
                                                class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <input type="file" name="image" class="getInputFile" id="validatedCustomFile"
                                               hidden/>
                                        <label class="my_file-label" for="validatedCustomFile"><i
                                                    class="fas fa-cloud-upload-alt"></i> Upload</label>
                                        <span id="my-file-chosen"></span>
                                        <br>
                                        <label class="pt-1" id="profileLabel" for="image">
                                        </label>
                                        <span class="text-danger">{{ $errors->has('image') ? $errors->first('image'):''}}</span>
                                    </div>
                                </div>

                                <button type="submit" class="float-right btn btn-primary">Save</button>
                            </form>
                        </div>
                    </div>
                </div> <!--col-6-->

                <div class="col-lg-6">
                    <div class="card shadow-lg border-0 rounded-lg mt-4 mb-3">
                        <div class="card-header"><h4 class="font-weight-light my-1">All Slider</h4></div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                      <th class="text-center" style="width: 70px">ID</th>
                                        <th>Title</th>
                                        <th class="text-center">Image</th>
                                      <th class="text-center" style="width: 170px">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($slider as $key=> $row)
                                        <tr>
                                            <td class="text-center">{{$key+1}}</td>
                                            <td>{{$row->title}}</td>
                                            <td class="text-center"><img width="100px" src="{{ asset('img/slider/'.$row->image)}}"></td>
                                            <td class="text-center">
                                                <a href="{{ route('slider.edit', ['id' => $row->id])}}"
                                                   class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
                                                <a href="{{ route('slider.destroy', ['id' => $row->id])}}"
                                                   onclick="return confirm('Are you sure to delete this!')"
                                                   class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> </a>
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
